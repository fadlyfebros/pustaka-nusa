<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Tampilkan form register
    public function showRegisterForm()
    {
        return view('pages.register');
    }

    // Proses registrasi
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|max:50|unique:login,username',
            'email' => 'required|email|unique:login,email',
            'password' => 'required|confirmed|min:6',
            'fullname' => 'required|max:100',
        ]);

        // Generate kode_user
        $lastUser = Login::select('kode_user')->orderBy('id', 'desc')->first();
        $newKodeUser = 'AP' . str_pad(($lastUser ? intval(substr($lastUser->kode_user, 2)) + 1 : 1), 3, '0', STR_PAD_LEFT);

        Login::create([
            'kode_user' => $newKodeUser,
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'kelas' => '-',
            'alamat' => '-',
            'verif' => 'Tidak',
            'role' => 'anggota',
            'terakhir_login' => now(),
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }

    // Tampilkan form login
    public function showLoginForm()
    {
        return view('pages.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = Login::where('username', $request->username)
            ->orWhere('email', $request->username)
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session_start();
            $_SESSION['user'] = [
                'id' => $user->id,
                'username' => $user->username,
                'fullname' => $user->fullname,
                'join_date' => $user->created_at,
                'last_login' => $user->terakhir_login,
                'verif' => $user->verif,
                'role' => $user->role,
            ];

            // Redirect berdasarkan peran pengguna
            return redirect($user->role === 'admin' ? 'admin' : 'anggota')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['login_error' => 'Username atau password salah!']);
    }

    // Logout
    public function logout()
    {
        session_start();
        session_destroy(); // Hapus semua sesi
        return redirect('/login')->with('success', 'Berhasil logout!');
    }

    // Tampilkan form lupa password
    public function showResetPasswordForm()
    {
        return view('pages.lupapassword');
    }

    // Kirim link reset password
    public function sendResetPasswordLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:login,email',
        ]);

        $user = Login::where('email', $request->email)->first();
        $token = Str::random(60);

        // Simpan token ke tabel password_resets
        DB::table('password_resets')->updateOrInsert(
            ['email' => $user->email],
            ['token' => $token, 'created_at' => now()]
        );

        $resetLink = url('/resetpassword/' . $token);

        // Kirim email
        Mail::send('emails.reset_password', [
            'username' => $user->username,
            'reset_link' => $resetLink,
        ], function ($message) use ($user) {
            $message->to($user->email)->subject('Permintaan Reset Password');
        });

        return back()->with('success', 'Link reset password telah dikirim ke email Anda.');
    }

    // Tampilkan form reset password
    public function showResetPassword($token)
    {
        return view('pages.resetpassword', ['token' => $token]);
    }

    // Proses reset password
    public function resetPassword(Request $request, $token)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        // Validasi token
        $resetRequest = DB::table('password_resets')->where('token', $token)->first();

        if (!$resetRequest) {
            return redirect('/login')->withErrors(['Token tidak valid atau telah kedaluwarsa.']);
        }

        // Cari user berdasarkan email
        $user = Login::where('email', $resetRequest->email)->first();

        if (!$user) {
            return redirect('/login')->withErrors(['User tidak ditemukan.']);
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        // Hapus token setelah berhasil
        DB::table('password_resets')->where('token', $token)->delete();

        return redirect('/login')->with('success', 'Password berhasil direset. Silakan login.');
    }
}

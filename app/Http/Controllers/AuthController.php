<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('pages.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|max:50|unique:login,username',
            'email' => 'required|email|unique:login,email',
            'password' => 'required|confirmed|min:6',
            'fullname' => 'required|max:100',
        ]);

        // Update kolom orderBy
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

    public function showLoginForm()
    {
        return view('pages.login');
    }

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
            Session::put('user', [
                'id' => $user->id, // Perbaikan di sini
                'username' => $user->username,
                'fullname' => $user->fullname,
                'join_date' => $user->created_at,
                'last_login' => $user->terakhir_login,
                'verif' => $user->verif,
                'role' => $user->role,
            ]);

            return redirect($user->role === 'admin' ? '/admin' : '/anggota')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['login_error' => 'Username atau password salah!']);
    }

    public function logout()
    {
        Session::forget('user');
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}

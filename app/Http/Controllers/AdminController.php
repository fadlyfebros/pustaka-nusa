<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Login::where('role', 'admin')->paginate(10);
        return view('admin.pages.dataadmin', compact('admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'username' => 'required|unique:login,username',
            'password' => 'required|min:6',
        ]);
        $email = $request->username . '@gmail.com';
        Login::create([
            'kode_user' => '-',
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $email,
            'password' => Hash::make($request->password),
            'kelas' => '-',
            'alamat' => '-',
            'verif' => 'iya',
            'role' => 'admin',
        ]);

        return redirect()->route('admin.pages.dataadmin')->with('success', 'Admin berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fullname' => 'required',
            'username' => 'required',
        ]);

        $admin = Login::findOrFail($id);
        $admin->update([
            'fullname' => $request->fullname,
            'username' => $request->username,
        ]);

        if ($request->password) {
            $admin->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.pages.dataadmin')->with('success', 'Admin berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $admin = Login::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.pages.dataadmin')->with('success', 'Admin berhasil dihapus.');
    }
}

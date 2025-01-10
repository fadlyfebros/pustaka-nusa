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

    public function create()
    {
        return view('admin.pages.createadmin');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'username' => 'required|unique:login,username',
            'email' => 'required|email|unique:login,email',
            'password' => 'required|min:6',
        ]);

        Login::create([
            'kode_user' => 'admin',
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'kelas' => '-',
            'alamat' => '-',
            'role' => 'admin',
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $admin = Login::findOrFail($id);
        return view('admin.pages.editadmin', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Login::findOrFail($id);

        $request->validate([
            'fullname' => 'required',
            'username' => 'required|unique:login,username,' . $id,
            'email' => 'required|email|unique:login,email,' . $id,
        ]);

        $admin->update([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
        ]);

        if ($request->password) {
            $admin->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.index')->with('success', 'Admin berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $admin = Login::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus.');
    }
}

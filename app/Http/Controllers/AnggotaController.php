<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Login::where('role', 'anggota')->paginate(10);
        return view('admin.pages.dataanggota', compact('anggota'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email|unique:login,email',
            'password' => 'required|min:6',
            'kelas' => 'required',
            'alamat' => 'required',
        ]);

        // Menggunakan helper generateKodeUser
        $newKodeUser = generateKodeUser();

        Login::create([
            'kode_user' => $newKodeUser,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'kelas' => $request->kelas,
            'alamat' => $request->alamat,
            'role' => 'anggota',
        ]);

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $anggota = Login::findOrFail($id);
        return view('admin.pages.edit', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email',
            'kelas' => 'required',
            'alamat' => 'required',
        ]);

        $anggota = Login::findOrFail($id);
        $anggota->update([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'kelas' => $request->kelas,
            'alamat' => $request->alamat,
        ]);

        if ($request->password) {
            $anggota->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $anggota = Login::findOrFail($id);
        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus.');
    }
}
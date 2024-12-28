<?php

namespace App\Http\Controllers;
use App\Models\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    public function index()
    {
        $penerbit = Penerbit::paginate(10);

        // Generate kode_penerbit baru
        $lastUser = Penerbit::select('kode_penerbit')->orderBy('id', 'desc')->first();
        $newKodePenerbit = 'P' . str_pad(($lastUser ? intval(substr($lastUser->kode_penerbit, 1)) + 1 : 1), 3, '0', STR_PAD_LEFT);

        return view('admin.pages.datapenerbit', compact('penerbit', 'newKodePenerbit'));
    }


    public function create()
    {
        return view('penerbit.create');
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'nama_penerbit' => 'required|max:255',
            'status' => 'required|in:Terverifikasi,Belum Terverifikasi',
        ]);

        // Generate kode_penerbit baru
        $lastUser = Penerbit::select('kode_penerbit')->orderBy('id', 'desc')->first();
        $newKodePenerbit = 'P' . str_pad(($lastUser ? intval(substr($lastUser->kode_penerbit, 1)) + 1 : 1), 3, '0', STR_PAD_LEFT);

        // Simpan data ke database dengan kode_penerbit yang di-generate
        Penerbit::create([
            'kode_penerbit' => $newKodePenerbit,
            'nama_penerbit' => $request->input('nama_penerbit'),
            'status' => $request->input('status'),
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('penerbit.index')->with('success', 'Penerbit berhasil ditambahkan.');
    }


    public function edit(Penerbit $penerbit)
    {
        return view('penerbit.edit', compact('penerbit'));
    }

    public function update(Request $request, Penerbit $penerbit)
    {
        $request->validate([
            'kode_penerbit' => 'required|max:50|unique:penerbits,kode_penerbit,' . $penerbit->id,
            'nama_penerbit' => 'required|max:255',
            'status' => 'required|in:Terverifikasi,Belum Terverifikasi',
        ]);
        $lastPenerbit = Penerbit::select('kode_penerbit')->orderBy('id', 'desc')->first();
        $newKodePenerbit = 'P' . str_pad(
            ($lastPenerbit ? intval(substr($lastPenerbit->kode_penerbit, 1)) + 1 : 1),
            3,
            '0',
            STR_PAD_LEFT
        );

        $penerbit->update([
            'kode_penerbit' => $newKodePenerbit,
            'nama_penerbit' => $request->input('nama_penerbit'),
            'status' => $request->input('status'),
        ]);
        return redirect()->route('penerbit.index')->with('success', 'Penerbit berhasil diperbarui.');
    }

    public function destroy(Penerbit $penerbit)
    {
        $penerbit->delete();
        return redirect()->route('penerbit.index')->with('success', 'Penerbit berhasil dihapus.');
    }
}

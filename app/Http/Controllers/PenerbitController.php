<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    // Method untuk generate kode penerbit
    private function generateKodePenerbit()
    {
        $lastUser = Penerbit::latest('id')->first();
        return 'P' . str_pad(($lastUser ? intval(substr($lastUser->kode_penerbit, 1)) + 1 : 1), 3, '0', STR_PAD_LEFT);
    }

    // Menampilkan halaman data penerbit
    public function index()
    {
        $penerbit = Penerbit::paginate(10); // Pagination
        $newKodePenerbit = $this->generateKodePenerbit();

        return view('admin.pages.datapenerbit', compact('penerbit', 'newKodePenerbit'));
    }

    // Menyimpan data penerbit baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_penerbit' => 'required|max:255',
            'status' => 'required|in:Terverifikasi,Belum Terverifikasi',
        ]);

        Penerbit::create([
            'kode_penerbit' => $this->generateKodePenerbit(),
            'nama_penerbit' => $request->nama_penerbit,
            'status' => $request->status,
        ]);

        return redirect()->route('datapenerbit.index')->with('success', 'Penerbit berhasil ditambahkan.');
    }

    // Menampilkan data penerbit untuk diedit
    public function edit($id)
    {
        $penerbit = Penerbit::find($id);

        if (!$penerbit) {
            return response()->json(['error' => 'Penerbit tidak ditemukan'], 404);
        }

        return response()->json($penerbit); // Return data penerbit sebagai JSON
    }

    // Memperbarui data penerbit
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_penerbit' => 'required|max:255',
            'status' => 'required|in:Terverifikasi,Belum Terverifikasi',
        ]);

        $penerbit = Penerbit::findOrFail($id);
        $penerbit->update($request->only('nama_penerbit', 'status'));

        return redirect()->route('datapenerbit.index')->with('success', 'Penerbit berhasil diperbarui.');
    }

    // Menghapus data penerbit
    public function destroy($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        $penerbit->delete();

        return redirect()->route('datapenerbit.index')->with('success', 'Penerbit berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PengembalianBuku;
use App\Models\PeminjamanBuku;
use Illuminate\Http\Request;

class PengembalianBukuController extends Controller
{
    public function index()
    {
        $pengembalian = PengembalianBuku::with(['user', 'book'])->get();
        $peminjaman = PeminjamanBuku::all();
        $user = session('user'); // Pastikan session user sudah diset di login.

        return view('anggota.pages.pengembalian', compact('pengembalian', 'peminjaman', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'tanggal_pengembalian' => 'required|date',
            'kondisi_buku' => 'required|string',
        ]);

        $denda = match ($request->kondisi_buku) {
            'Baik' => 0,
            'Rusak' => 20000,
            'Hilang' => 50000,
            default => 0,
        };

        PengembalianBuku::create([
            'user_id' => session('user')['id'],
            'book_id' => $request->book_id,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'kondisi_buku' => $request->kondisi_buku,
            'denda' => $denda,
        ]);

        return redirect()->route('anggota.pages.pengembalian.index')->with('success', 'Pengembalian berhasil ditambahkan!');
    }
}

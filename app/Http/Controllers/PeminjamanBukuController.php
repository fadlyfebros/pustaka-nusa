<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanBuku;
use App\Models\Book;
use App\Models\Login;
use Illuminate\Http\Request;

class PeminjamanBukuController extends Controller
{
    public function index()
    {
        // Ambil user dari session
        $user = session('user');

        // Jika user tidak ditemukan di session
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data jumlah buku yang dipinjam
        $jumlahBukuDipinjam = PeminjamanBuku::where('user_id', $user['id'])->count();

        // Ambil data peminjaman
        $peminjaman = PeminjamanBuku::with(['user', 'book'])
            ->where('user_id', $user['id'])
            ->get();

        // Ambil data buku
        $books = Book::all();

        return view('anggota.pages.peminjaman', compact('peminjaman', 'books', 'user', 'jumlahBukuDipinjam'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:login,id',
            'book_id' => 'required|exists:books,id',
            'tanggal_peminjaman' => 'required|date',
        ]);

        $tanggal_peminjaman = $request->tanggal_peminjaman;
        $tanggal_pengembalian = date('Y-m-d', strtotime($tanggal_peminjaman . ' +14 days')); // 2 minggu dari tanggal peminjaman

        PeminjamanBuku::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'tanggal_peminjaman' => $tanggal_peminjaman,
            'tanggal_pengembalian' => $tanggal_pengembalian
        ]);

        session()->flash('tanggal_pengembalian', date('d-m-Y', strtotime($tanggal_pengembalian)));

        return redirect()->route('anggota.pages.peminjaman.index')->with('success', 'Peminjaman berhasil ditambahkan!');
    }
}

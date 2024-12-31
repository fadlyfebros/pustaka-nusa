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
        $peminjaman = PeminjamanBuku::with(['user', 'book'])->get();
        $books = Book::all();
        $user = session('user');

        return view('anggota.pages.peminjaman', compact('peminjaman', 'books', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:login,id',
            'book_id' => 'required|exists:books,id',
            'tanggal_peminjaman' => 'required|date',
            'tanggal_pengembalian' => 'required|date|after:tanggal_peminjaman',
            'kondisi_buku' => 'required|string',
        ]);

        PeminjamanBuku::create($request->all());

        return redirect()->route('anggota.pages.peminjaman.index')->with('success', 'Peminjaman berhasil ditambahkan!');
    }
}

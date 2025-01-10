<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeminjamanBuku;
use App\Models\PengembalianBuku;
use App\Models\Book;

class PengembalianBukuController extends Controller
{
    public function index()
    {
        // Ambil user dari session
        $user = session('user');

        // Jika session user tidak ada, redirect ke login
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data buku yang sedang dipinjam oleh user
        $peminjaman = PeminjamanBuku::with('book')
            ->where('user_id', $user['id'])
            ->get();

        // Ambil data riwayat pengembalian
        $pengembalian = PengembalianBuku::with('book')
            ->where('user_id', $user['id'])
            ->get();

        return view('anggota.pages.pengembalian', compact('peminjaman', 'pengembalian', 'user'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'tanggal_pengembalian' => 'required|date',
        ]);

        // Ambil data peminjaman berdasarkan book_id
        $peminjaman = PeminjamanBuku::where('book_id', $request->book_id)
            ->where('user_id', session('user')['id'])
            ->first();

        // Jika buku tidak ditemukan dalam daftar peminjaman
        if (!$peminjaman) {
            return redirect()->back()->with('error', 'Buku ini tidak ditemukan dalam daftar peminjaman Anda.');
        }

        // Hitung keterlambatan dalam hari
        $tanggal_pengembalian = $request->tanggal_pengembalian;
        $tanggal_batas = $peminjaman->tanggal_pengembalian;
        $diff = (strtotime($tanggal_pengembalian) - strtotime($tanggal_batas)) / (60 * 60 * 24);

        $denda = 0;
        $status = 'Tepat Waktu';
        $notifikasi = 'Buku berhasil dikembalikan tanpa denda.';

        if ($diff > 0) {
            $denda = 10000 + (($diff - 1) * 5000);
            $status = 'Telat Mengembalikan';
            $notifikasi = "Anda telat $diff hari. Denda: Rp. $denda.";
        }

        if ($diff > 30) {
            $status = 'Tidak Dikembalikan';
            $notifikasi = 'Buku tidak dikembalikan. Anda akan dilaporkan ke pihak berwajib.';
            return redirect()->back()->with('error', $notifikasi);
        }

        // Simpan data pengembalian
        PengembalianBuku::create([
            'user_id' => $peminjaman->user_id,
            'book_id' => $peminjaman->book_id,
            'tanggal_pengembalian' => $tanggal_pengembalian,
            'denda' => $denda,
            'status' => $status,
        ]);

        // Hapus data peminjaman
        $peminjaman->delete();

        return redirect()->route('anggota.pages.pengembalian.index')->with('success', $notifikasi);
    }
}

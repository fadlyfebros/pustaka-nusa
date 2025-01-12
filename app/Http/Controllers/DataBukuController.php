<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PeminjamanBuku;
use App\Models\PengembalianBuku;

class DataBukuController extends Controller
{
    /**
     * Tampilkan halaman data buku gabungan (peminjaman dan pengembalian).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil data peminjaman
        $peminjaman = PeminjamanBuku::with(['user', 'book'])
            ->select(
                'id',
                'user_id',
                'book_id',
                'tanggal_peminjaman',
                'tanggal_pengembalian',
                DB::raw('0 as denda'),
                DB::raw('"Dipinjam" as status')
            );

        // Ambil data pengembalian
        $pengembalian = PengembalianBuku::with(['user', 'book'])
            ->select(
                'id',
                'user_id',
                'book_id',
                DB::raw('null as tanggal_peminjaman'),
                'tanggal_pengembalian',
                'denda',
                'status'
            );

        $dataBuku = $peminjaman->union($pengembalian)
            ->orderBy('tanggal_peminjaman', 'desc')
            ->get();

        // Return data ke view
        return view('admin.pages.datapeminjamanbuku', compact('dataBuku'));
    }
}

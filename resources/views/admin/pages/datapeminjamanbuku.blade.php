@extends('admin.layout')

@section('title', 'Data Buku - Peminjaman dan Pengembalian')

@section('content')
<div class="p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex align-items-center">
            <h1 class="mb-0 me-3">Data Peminjaman Buku</h1>
            <p class="mb-0 text-muted">{{ formatTanggal() }}</p>
        </div>
        <div class="text-end">
            <nav aria-label="breadcrumb" class="mb-1">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="/admin" style="text-decoration: none; color: black; display: flex; align-items: center; gap: 5px;">
                            <i class="bi bi-house"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Data Peminjaman Buku</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table id="tableBuku" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Denda</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataBuku as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->user->fullname }}</td>
                            <td>{{ $item->book->judul_buku }}</td>
                            <td>{{ $item->tanggal_peminjaman }}</td>
                            <td>{{ $item->tanggal_pengembalian ?? 'Belum Dikembalikan' }}</td>
                            <td>{{ $item->denda ? 'Rp '.number_format($item->denda, 0, ',', '.') : 'Rp 0' }}</td>
                            <td>{{ $item->status }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data buku.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

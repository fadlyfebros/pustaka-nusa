@extends('admin.layout')

@section('title', 'Data Peminjaman Buku')

@section('content')
<div class="p-4">
    <h1>Data Peminjaman Buku</h1>

    <div class="card">
        <div class="card-body">
            <table id="tablePeminjaman" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Kondisi Buku Saat Dipinjam</th>
                        <th>Kondisi Buku Saat Dikembalikan</th>
                        <th>Denda</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($peminjaman as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->user->fullname }}</td>
                            <td>{{ $item->book->judul_buku }}</td>
                            <td>{{ $item->tanggal_peminjaman }}</td>
                            <td>{{ $item->tanggal_pengembalian }}</td>
                            <td>{{ $item->kondisi_saat_dipinjam }}</td>
                            <td>{{ $item->kondisi_saat_dikembalikan ?? 'Belum Dikembalikan' }}</td>
                            <td>{{ $item->denda ? 'Rp '.number_format($item->denda, 0, ',', '.') : 'Rp 0' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Belum ada data peminjaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#tablePeminjaman').DataTable();
    });
</script>
@endsection

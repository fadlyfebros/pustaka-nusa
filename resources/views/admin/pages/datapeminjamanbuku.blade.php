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
                    <!-- Example Data -->
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>Pemrograman Laravel</td>
                        <td>2024-12-20</td>
                        <td>2024-12-27</td>
                        <td>Baik</td>
                        <td>Rusak</td>
                        <td>Rp 50,000</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>Desain Database</td>
                        <td>2024-12-15</td>
                        <td>2024-12-25</td>
                        <td>Baik</td>
                        <td>Baik</td>
                        <td>Rp 0</td>
                    </tr>
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

@extends('anggota.layout')

@section('title', 'Pengembalian Buku')

@section('content')
<div class="p-4">
    <h1 class="mb-3">Pengembalian Buku</h1>
    <div class="card shadow-sm">
        <div class="card-body">
            <ul class="nav nav-tabs mb-4" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#form-pengembalian" role="tab">Formulir Pengembalian Buku</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#riwayat-pengembalian" role="tab">Riwayat Pengembalian Buku</a>
                </li>
            </ul>
            <div class="tab-content">
                <!-- Formulir Pengembalian -->
                <div class="tab-pane fade show active" id="form-pengembalian" role="tabpanel">
                    <form method="POST" action="{{ route('anggota.pages.pengembalian.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="judulBuku" class="form-label">Judul Buku</label>
                            <select id="judulBuku" name="book_id" class="form-select" required>
                                <option selected>-- Pilih Buku --</option>
                                @foreach ($peminjaman as $item)
                                    <option value="{{ $item->book_id }}">{{ $item->book->judul_buku }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tanggalPengembalian" class="form-label">Tanggal Pengembalian</label>
                            <input type="date" id="tanggalPengembalian" name="tanggal_pengembalian" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="kondisiBuku" class="form-label">Kondisi Buku</label>
                            <select id="kondisiBuku" name="kondisi_buku" class="form-select" required>
                                <option value="">-- Pilih Kondisi Buku --</option>
                                <option value="Baik">Baik (Tidak terkena denda)</option>
                                <option value="Rusak">Rusak (Denda Rp 20.000)</option>
                                <option value="Hilang">Hilang (Denda Rp 50.000)</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Kirim</button>
                    </form>
                </div>

                <!-- Riwayat Pengembalian -->
                <div class="tab-pane fade" id="riwayat-pengembalian" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Anggota</th>
                                    <th>Judul Buku</th>
                                    <th>Tanggal Pengembalian</th>
                                    <th>Kondisi Buku</th>
                                    <th>Denda</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pengembalian as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->fullname }}</td>
                                        <td>{{ $item->book->judul_buku }}</td>
                                        <td>{{ $item->tanggal_pengembalian }}</td>
                                        <td>{{ $item->kondisi_buku }}</td>
                                        <td>{{ $item->denda ? 'Rp ' . number_format($item->denda, 0, ',', '.') : '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada riwayat pengembalian buku.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

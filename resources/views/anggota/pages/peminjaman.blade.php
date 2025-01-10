@extends('anggota.layout')

@section('title', 'Peminjaman Buku')

@section('content')
<div class="p-3">
    <!-- Header dengan Tanggal -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <h1 class="mb-0 me-3">Peminjaman Buku</h1>
            <p class="mb-0 text-muted">{{ now()->format('d-m-Y') }}</p>
        </div>
        <div class="text-end">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="/anggota" class="text-decoration-none text-dark">
                            <i class="bi bi-house"></i> Home
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Peminjaman Buku</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Card Formulir Peminjaman -->
    <div class="card shadow-sm">
        <div class="card-body">
            <!-- Tab Navigasi -->
            <ul class="nav nav-tabs mb-4" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#form-peminjaman" role="tab">Formulir Peminjaman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#riwayat-peminjaman" role="tab">Riwayat Peminjaman</a>
                </li>
            </ul>

            <div class="tab-content">
                <!-- Formulir Peminjaman -->
                <div class="tab-pane fade show active" id="form-peminjaman" role="tabpanel">
                    @if ($user)
                        <form method="POST" action="{{ route('anggota.pages.peminjaman.store') }}">
                            @csrf
                            <!-- Notifikasi -->
                            @if ($jumlahBukuDipinjam > 0)
                                <div class="alert alert-info">
                                    Kamu saat ini telah meminjam sebanyak {{ $jumlahBukuDipinjam }} buku.
                                </div>
                            @endif

                            @if (session('tanggal_pengembalian'))
                                <div class="alert alert-warning">
                                    Tanggal maksimal pengembalian adalah <strong>{{ session('tanggal_pengembalian') }}</strong>.
                                </div>
                            @endif

                            <!-- Input Nama Anggota -->
                            <div class="mb-3">
                                <label for="namaAnggota" class="form-label">Nama Anggota</label>
                                <input type="text" id="namaAnggota" name="fullname" class="form-control"
                                    value="{{ $user['fullname'] ?? 'Data tidak tersedia' }}" readonly>
                                <input type="hidden" name="user_id" value="{{ $user['id'] ?? '' }}">
                            </div>


                            <!-- Input Judul Buku -->
                            <div class="mb-3">
                                <label for="judulBuku" class="form-label">Judul Buku</label>
                                <select id="judulBuku" name="book_id" class="form-select" required>
                                    <option disabled selected>-- Pilih Buku --</option>
                                    @foreach ($books as $book)
                                        <option value="{{ $book->id }}">{{ $book->judul_buku }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Input Tanggal Peminjaman -->
                            <div class="mb-3">
                                <label for="tanggalPeminjaman" class="form-label">Tanggal Peminjaman</label>
                                <input type="date" id="tanggalPeminjaman" name="tanggal_peminjaman" class="form-control" required>
                            </div>

                            <!-- Tombol Submit -->
                            <button type="submit" class="btn btn-primary w-100">Pinjam Buku</button>
                        </form>
                    @else
                        <p class="text-danger text-center">Data pengguna tidak tersedia. Silakan login ulang.</p>
                    @endif
                </div>

                <!-- Riwayat Peminjaman -->
                <div class="tab-pane fade" id="riwayat-peminjaman" role="tabpanel">
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Anggota</th>
                                    <th>Judul Buku</th>
                                    <th>Tanggal Peminjaman</th>
                                    <th>Batas Pengembalian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($peminjaman as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->fullname }}</td>
                                        <td>{{ $item->book->judul_buku }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->tanggal_peminjaman)) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->tanggal_pengembalian)) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Belum ada riwayat peminjaman.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div> <!-- Akhir Tab Riwayat -->
            </div>
        </div>
    </div>
</div>
@endsection

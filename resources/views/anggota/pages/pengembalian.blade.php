@extends('anggota.layout')

@section('title', 'Pengembalian Buku')

@section('content')
<div class="p-3">
    <h1>Pengembalian Buku</h1>
    <p class="text-muted">{{ now()->format('d-m-Y') }}</p>

    <div class="card shadow-sm">
        <div class="card-body">
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#form-pengembalian">Formulir Pengembalian</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#riwayat-pengembalian">Riwayat Pengembalian</a>
                </li>
            </ul>

            <div class="tab-content">
                <!-- Form Pengembalian -->
                <div class="tab-pane fade show active" id="form-pengembalian">
                    <form method="POST" action="{{ route('anggota.pages.pengembalian.store') }}">
                        @csrf
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <div class="mb-3">
                            <label for="book_id" class="form-label">Pilih Buku yang Ingin Dikembalikan</label>
                            <select class="form-select" name="book_id" required>
                                <option disabled selected>-- Pilih Buku --</option>
                                @foreach ($peminjaman as $item)
                                    <option value="{{ $item->book->id }}">{{ $item->book->judul_buku }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_pengembalian" class="form-label">Tanggal Pengembalian</label>
                            <input type="date" class="form-control" name="tanggal_pengembalian" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Kembalikan Buku</button>
                    </form>
                </div>

                <!-- Riwayat Pengembalian -->
                <div class="tab-pane fade" id="riwayat-pengembalian">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Denda</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pengembalian as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->book->judul_buku }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->tanggal_pengembalian)) }}</td>
                                    <td>Rp. {{ number_format($item->denda, 0, ',', '.') }}</td>
                                    <td>{{ $item->status }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Belum ada riwayat pengembalian.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

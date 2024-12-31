@extends('anggota.layout')

@section('title', 'Peminjaman Buku')

@section('content')
<div class="p-4">
    <h1 class="mb-3">Peminjaman Buku</h1>
    <div class="card shadow-sm">
        <div class="card-body">
            <ul class="nav nav-tabs mb-4" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#form-peminjaman" role="tab">Formulir Peminjaman Buku</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#riwayat-peminjaman" role="tab">Riwayat Peminjaman Buku</a>
                </li>
            </ul>
            <div class="tab-content">
                <!-- Formulir Peminjaman -->
                <div class="tab-pane fade show active" id="form-peminjaman" role="tabpanel">
                    @if ($user)
                        <form method="POST" action="{{ route('anggota.pages.peminjaman.store') }}">
                            @csrf
                            <!-- Nama Anggota -->
                            <div class="mb-3">
                                <label for="namaAnggota" class="form-label">Nama Anggota</label>
                                <input type="text" id="namaAnggota" name="fullname" class="form-control"
                                    value="{{ $user['fullname'] }}" readonly>
                                <input type="hidden" name="user_id" value="{{ $user['id'] }}">
                            </div>

                            <!-- Judul Buku -->
                            <div class="mb-3">
                                <label for="judulBuku" class="form-label">Judul Buku</label>
                                <select id="judulBuku" name="book_id" class="form-select" required>
                                    <option selected>-- Pilih Buku --</option>
                                    @foreach ($books as $book)
                                        <option value="{{ $book->id }}">{{ $book->judul_buku }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Tanggal Peminjaman -->
                            <div class="mb-3">
                                <label for="tanggalPeminjaman" class="form-label">Tanggal Peminjaman</label>
                                <input type="date" id="tanggalPeminjaman" name="tanggal_peminjaman" class="form-control" required>
                            </div>

                            <!-- Tanggal Pengembalian -->
                            <div class="mb-3">
                                <label for="tanggalPengembalian" class="form-label">Tanggal Pengembalian</label>
                                <input type="date" id="tanggalPengembalian" name="tanggal_pengembalian" class="form-control" required>
                            </div>

                            <!-- Kondisi Buku -->
                            <div class="mb-3">
                                <label for="kondisiBuku" class="form-label">Kondisi Buku Saat Ini</label>
                                <select id="kondisiBuku" name="kondisi_buku" class="form-select" required>
                                    <option selected>-- Silahkan pilih kondisi buku --</option>
                                    <option value="Baik">Baik</option>
                                    <option value="Rusak">Rusak</option>
                                </select>
                            </div>

                            <!-- Tombol Kirim -->
                            <button type="submit" class="btn btn-primary w-100">Kirim</button>
                        </form>
                    @else
                        <p class="text-danger">Data user tidak tersedia. Silakan login ulang.</p>
                    @endif
                </div>

                <!-- Riwayat Peminjaman -->
                <div class="tab-pane fade" id="riwayat-peminjaman" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Anggota</th>
                                    <th>Judul Buku</th>
                                    <th>Tanggal Peminjaman</th>
                                    <th>Tanggal Pengembalian</th>
                                    <th>Kondisi Buku</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($peminjaman as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->fullname }}</td>
                                        <td>{{ $item->book->judul_buku }}</td>
                                        <td>{{ $item->tanggal_peminjaman }}</td>
                                        <td>{{ $item->tanggal_pengembalian }}</td>
                                        <td>{{ $item->kondisi_buku }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada riwayat peminjaman buku.</td>
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

@extends('admin.layout')

@section('title', 'Home')

@section('content')
<div class="p-4">
    <h1 class="mb-3">Dashboard</h1>
    <p class="alert alert-secondary">
        {{ ucapanWaktu() }}, Selamat datang <strong>{{ session('user.fullname') }}</strong> di Pustaka Nusa.
    </p>

    <div class="row my-4">
        <!-- Anggota -->
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h2>{{ $jumlahAnggota }}</h2> <!-- Menampilkan jumlah anggota -->
                        <p>Anggota</p>
                    </div>
                    <i class="fas fa-user fa-2x"></i>
                </div>
                <div class="card-footer text-center">
                    <a href="/admin/anggota" class="text-white text-decoration-none">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <!-- Buku -->
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h2>2</h2>
                        <p>Buku</p>
                    </div>
                    <i class="fas fa-book fa-2x"></i>
                </div>
                <div class="card-footer text-center">
                    <a href="#" class="text-white text-decoration-none">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <!-- Peminjaman -->
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h2>2</h2>
                        <p>Peminjaman</p>
                    </div>
                    <i class="fas fa-book-reader fa-2x"></i>
                </div>
                <div class="card-footer text-center">
                    <a href="#" class="text-white text-decoration-none">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <!-- Pengembalian -->
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h2>0</h2>
                        <p>Pengembalian</p>
                    </div>
                    <i class="fas fa-undo fa-2x"></i>
                </div>
                <div class="card-footer text-center">
                    <a href="#" class="text-white text-decoration-none">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center">
        <img src="img/logo.png" alt="Pustaka Nusa Logo">
        <h2 class="mt-3">Pustaka Nusa</h2>
    </div>

</div>
@endsection

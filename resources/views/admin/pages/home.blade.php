@extends('admin.layout')

@section('title', 'Home - Pustaka Nusa')

@section('content')
<div class="p-1">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center">
                <h1 class="mb-0 me-3">Dashboard</h1>
                <p class="mb-0 text-muted">{{ formatTanggal() }}</p>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="/admin" style="text-decoration: none; color: black; display: flex; align-items: center; gap: 5px;">
                            <i class="bi bi-house"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>

        <p class="alert alert-secondary">
            {{ ucapanWaktu() }}, Selamat datang <strong>{{ session('user.fullname') }}</strong> di Pustaka Nusa.
        </p>

        <!-- Gambar -->
        <div class="text-center">
            <img src="img/logo.png" alt="Pustaka Nusa Logo" class="img-fluid" style="max-width: 300px;">
            <h2 class="mt-3">Pustaka Nusa</h2>
        </div>
    </div>
</div>
@endsection

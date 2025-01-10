@extends('anggota.layout')

@section('title', 'Home')

@section('content')
    <div class="p-1">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center">
                <h1 class="mb-0 me-3">Dashboard</h1>
                <p class="mb-0 text-muted">{{ formatTanggal() }}</p>
            </div>
            <div class="text-end">
                <nav aria-label="breadcrumb" class="mb-1">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="/anggota" style="text-decoration: none; color: black; display: flex; align-items: center; gap: 5px;">
                                <i class="bi bi-house"></i>
                                <span>Home</span>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
        <p class="alert alert-secondary">
            {{ ucapanWaktu() }}, Selamat datang <strong>{{ session('user.fullname') }}</strong> di Pustaka Nusa.
        </p>
        <div class="text-center">
            <img src="img/logo.png" alt="Pustaka Nusa Logo">
            <h2 class="mt-3">Pustaka Nusa</h2>
        </div>
    </div>
@endsection

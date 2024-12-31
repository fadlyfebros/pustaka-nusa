@extends('anggota.layout')

@section('title', 'Home')

@section('content')
    <div class="p-4">
        <h1 class="mb-3">Dashboard</h1>
        <p class="alert alert-secondary">
            {{ ucapanWaktu() }}, Selamat datang <strong>{{ session('user.fullname') }}</strong> di Pustaka Nusa.
        </p>
        <div class="text-center">
            <img src="img/logo.png" alt="Pustaka Nusa Logo">
            <h2 class="mt-3">Pustaka Nusa</h2>
        </div>
    </div>
@endsection

@extends('layout')
@section('title', 'Contact Us - Pustaka Nusa')
@section('content')

<div class="container mt-5 contact-section">
    <h2 class="text-center">Kontak Kami</h2>
    <h6 class="text-center mb-4">Hubungi Tim Kami</h6>

    <!-- Form Contact Us -->
    <form action="{{ route('contact.send') }}" method="POST">
        <!-- Pesan Sukses -->
        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
        </div>
        <div class="mb-3">
            <label for="subject" class="form-label">Subjek</label>
            <input type="text" class="form-control" id="subject" name="subject" placeholder="Masukkan subjek" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Pesan</label>
            <textarea class="form-control" id="message" name="message" rows="4" placeholder="Tulis pesan Anda" required></textarea>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary w-25 custom-button">Kirim Pesan</button>
        </div>
    </form>
</div>

<style>
    .custom-button {
        border-radius: 100px;
    }
</style>

@endsection

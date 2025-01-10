@extends('layout')

@section('title', 'About - Pustaka Nusa')

@section('content')
<div class="hero-section d-flex flex-lg-row flex-column align-items-center justify-content-between p-5"
     style="animation: fadeIn 1s ease-out;">
    <!-- Text Content -->
    <div class="hero-text text-lg-start text-center"
         style="animation: slideInLeft 1.5s ease-out;">
        <h1 class="fw-bold" style="animation: fadeInText 2s ease-in-out;">Tentang <span style="color: #58C6BC;">Pustaka Nusa</span></h1>
        <p style="animation: fadeInText 2.5s ease-in-out;">
            <strong>Pustaka Nusa</strong> merupakan perpustakaan yang sudah berdiri sejak tahun zaman penjajahan.
            menyediakan berbagai koleksi buku yang dapat kamu pinjam maupun kamu baca ditempat.
        </p>
        <p style="animation: fadeInText 3s ease-in-out;">
            Pustaka Nusa selain tempat membaca buku juga merupakan tempat yang nyaman untuk mengerjakan tugas
            sembari melihat referensi buku yang ada.
        </p>
        <div class="mt-4" style="animation: bounceIn 2s;">
            <a href="/login"
               class="btn"
               style="background-color: #58C6BC; color: white; border-color: #58C6BC;
                      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                      transition: transform 0.2s, box-shadow 0.2s;
                      animation: pulse 3s infinite;">
                Mulai Baca
            </a>
            <a href="/login"
               class="btn btn-outline-primary"
               style="color: #58C6BC; border-color: #58C6BC;
                      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                      transition: transform 0.2s, box-shadow 0.2s;
                      animation: pulse 3s infinite;">
                Anda Ingin Meminjam Buku
            </a>
        </div>
    </div>

    <!-- Image Section -->
    <div class="hero-image" style="animation: slideInRight 1.5s ease-out;">
        <img src="{{ asset('img/about.png') }}" alt="Library Illustration" class="img-fluid">
    </div>
</div>

<!-- Tambahkan Animasi dengan CSS -->
<style>
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideInLeft {
        from { transform: translateX(-100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }

    @keyframes slideInRight {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }

    @keyframes fadeInText {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes bounceIn {
        0% { transform: scale(0.9); opacity: 0; }
        50% { transform: scale(1.05); opacity: 1; }
        100% { transform: scale(1); }
    }

    @keyframes pulse {
        0%, 100% { box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        50% { box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2); }
    }

    /* Hover effect for "Anda Ingin Meminjam Buku" */
    .btn-outline-primary:hover {
        background-color: #58C6BC !important; /* Change background to white on hover */
        color: white !important; /* Change text color to white on hover */
        border-color: #58C6BC !important; /* Keep border color as #58C6BC on hover */
        opacity: 0.7;
    }
</style>
@endsection

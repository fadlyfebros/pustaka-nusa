@extends('layout')

@section('title', 'Home - Pustaka Nusa')

@section('content')
<div class="hero-section d-flex flex-lg-row flex-column align-items-center"
     style="animation: fadeIn 1s ease-out;">
    <!-- Text Section -->
    <div class="hero-text text-center text-lg-start"
         style="animation: slideInLeft 1.5s ease-out;">
        <p style="animation: fadeInText 2s ease-in-out;">
            Mari baca buku dan tingkatkan ilmu
        </p>
        <h1 style="animation: fadeInText 2.5s ease-in-out;">
            Selamat Datang Di <br> Perpustakaan <br> Pustaka Nusa
        </h1>
        <a class="custom-button"
           href="/login"
           style="background-color: #58C6BC; color: white; padding: 10px 20px; border-radius: 8px;
                  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); text-decoration: none;
                  transition: transform 0.2s, box-shadow 0.2s; animation: bounceIn 2.5s;"
           onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 6px 10px rgba(0, 0, 0, 0.2)';"
           onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)';">
            Mulai Baca
        </a>
    </div>

    <!-- Image Section -->
    <div class="hero-image-container"
         style="animation: slideInRight 1.5s ease-out;">
        <img src="img/hero.png" alt="Hero Image" class="img-fluid custom-img"
             style="animation: fadeIn 2s;">
    </div>
</div>

<!-- Tambahkan Animasi dengan CSS -->
<style>
    /* Animasi Keyframes */
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
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes bounceIn {
        0% { transform: scale(0.9); opacity: 0; }
        50% { transform: scale(1.05); opacity: 1; }
        100% { transform: scale(1); }
    }

    /* Gaya Tambahan */
    .custom-button {
        font-weight: bold;
        text-transform: uppercase;
    }

    .custom-img {
        max-width: 100%;
        height: auto;
        /* Tidak ada shadow */
        box-shadow: none;
    }
</style>
@endsection

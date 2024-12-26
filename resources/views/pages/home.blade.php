@extends('layout')

@section('title', 'Home')

@section('content')
<div class="hero-section d-flex flex-lg-row flex-column align-items-center">
    <div class="hero-text text-center text-lg-start">
        <p>Mari baca buku dan tingkatkan ilmu</p>
        <h1>Selamat Datang Di <br> Perpustakaan <br>Pustaka Nusa</h1>
        <a class="custom-button" href="/login">Mulai Baca</a>
    </div>
    <div>
        <img src="img/hero.png" alt="Hero Image" class="img-fluid custom-img">
    </div>
</div>
@endsection

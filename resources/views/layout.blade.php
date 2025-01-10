<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pustaka Nusa')</title>
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'Britannic';
            src: url('resource/fonts/Britannic.ttf') format('truetype');
        }
        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            font-family: 'Britannic', sans-serif;
            font-weight: bold;
            gap: 10px;
        }
        .custom-button {
            background-color: #58C6BC;
            border-radius: 31px;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border: none;
            margin-top: 20px;
        }
        .hero-image-container {
            margin-left: 200px;
        }
        .hero-text p {
            font-size: 1.2rem;
        }
        .hero-text h1 {
            font-size: 2.5rem;
            margin-bottom: 50px;
        }
        .contact-section{
            margin-bottom: 50px;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .hero-image-container {
                margin: auto; /* Posisikan gambar di tengah */
                text-align: center;
            }
            .hero-text p {
                font-size: 2rem; /* Perbesar teks pada mobile */
            }
            .hero-text h1 {
                font-size: 2rem; /* Perbesar heading pada mobile */
            }
            .khusus{
                flex: 1;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Content -->
    <div class="khusus container mt-4">
        @yield('content')
    </div>

    <!-- Footer -->
    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

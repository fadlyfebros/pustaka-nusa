<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @section('title', 'Login - Pustaka Nusa')
    <title>@yield('title', 'Pustaka Nusa')</title>
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #B9E5E8;
            opacity: 0;
            animation: fadeIn 1.5s ease-out forwards;
        }

        /* Efek Fade-in saat load */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-container {
            text-align: center;
            max-width: 400px;
            padding: 20px;
            animation: slideIn 1.2s ease-out;
        }

        /* Efek slide dari bawah */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-container h4, .login-container h3, .login-container p {
            animation: fadeInText 1.5s ease-out forwards;
        }

        /* Efek untuk teks */
        @keyframes fadeInText {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .login-container img {
            width: 200px;
            margin-bottom: 20px;
            transform: scale(0.9);
            transition: transform 0.5s ease;
        }

        .login-container img:hover {
            transform: scale(1);
        }

        .login-container .form-control {
            border-radius: 25px;
        }

        .login-container .btn-primary {
            background-color: #58c6bc;
            border: none;
            border-radius: 25px;
            transition: all 0.3s ease-in-out;
        }

        /* Animasi saat tombol di-hover */
        .login-container .btn-primary:hover {
            background-color: #45b8a9;
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .footer-text {
            margin-top: 20px;
            color: #6c757d;
            font-size: 14px;
        }

        .footer-text a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }

        /* Animasi hover link */
        .footer-text a:hover {
            color: #58c6bc;
        }

        .logo-container {
            background-color: #ffffff;
            border-radius: 0 0 60px 60px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            max-width: 400px;
            width: 100%;
            position: relative;
            z-index: 0;
            top: -75px;
            text-align: center;
            margin-bottom: 10px;
        }

        h4 {
            font-family: 'Britannic', sans-serif;
            font-size: 30px;
        }

        .logo-container .font-britannic {
            display: block;
            margin-top: 10px;
            font-size: 30px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Logo -->
        <div class="logo-container">
            <img src="{{ asset('img/logo.png') }}" alt="Yarsi Logo">
            <h4 class="mt-3">Pustaka Nusa</h4>
        </div>

        <!-- Title -->
        <h3 class="mt-3">Login</h3>
        <p>Masukkan <i>username</i> dan <i>password</i> Anda</p>

        <!-- Flash Message -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first('login_error') }}
            </div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Masuk</button>
        </form>

        <!-- Footer Link -->
        <div class="footer-text">
            <p>Belum daftar? <a href="{{ route('register') }}">Daftar di sini</a></p>
        </div>
        <div class="footer-text">
            <p>Kembali ke halaman <a href="{{ url('/') }}">Home</a></p>
        </div>
        <div class="footer-text">
            <p>&copy; 2024 <a href="#">Pustaka Nusa</a></p>
        </div>
    </div>
</body>
</html>

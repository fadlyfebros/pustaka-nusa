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
        }
        .login-container {
            text-align: center;
            max-width: 400px;
            padding: 20px;
        }
        .login-container img {
            width: 200px;
            margin-bottom: 20px;
        }
        .login-container .form-control {
            border-radius: 25px;
        }
        .login-container .btn-primary {
            background-color: #58c6bc;
            border: none;
            border-radius: 25px;
        }
        .footer-text {
            margin-top: 20px;
            color: #6c757d;
            font-size: 14px;
        }
        .footer-text a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Logo -->
        <img src="img/logo.png" alt="Logo Pustaka Nusa">

        <!-- Title -->
        <h4>Login</h4>
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
    </div>
</body>
</html>

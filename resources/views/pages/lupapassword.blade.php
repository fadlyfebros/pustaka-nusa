<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    @section('title', 'Lupa Password - Pustaka Nusa')
    <title>@yield('title', 'Pustaka Nusa')</title>
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
            width: 300px;
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
        h4 {
            font-family: 'Britannic', sans-serif;
            font-size: 30px;
        }
        .logo-container {
            background-color: #ffffff;
            border-radius: 0 0 60px 60px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            position: relative;
            z-index: 0;
            top: -71px;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Logo -->
        <div class="logo-container">
            <!-- Title -->
            <img src="{{ asset('img/logo.png') }}" alt="Yarsi Logo">
            <h4 class="mt-3">Pustaka Nusa</h4>
        </div>

        <h3 class="mt-3">Lupa Password</h3>
        <p>Masukan Email anda untuk reset password  </p>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('password.request') }}" method="POST">
            @csrf
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Kirim Link Reset Password</button>
        </form>
        <div class="footer-text">
            <p>Kembali ke halaman <a href="{{ url('/Login') }}" style="color: #007bff;">Login</a></p>
        </div>
        <div class="footer-text">
            <p>&copy; 2024 <a href="#">Pustaka Nusa</a></p>
        </div>
    </div>

    <!-- Bootstrap JS and Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pustaka Nusa')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'Britannic';
            src: url('path-to-your-font/Britannic-Bold.ttf') format('truetype');
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
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Content -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Footer -->
    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

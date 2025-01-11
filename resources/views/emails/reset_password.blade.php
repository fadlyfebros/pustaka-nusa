<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @section('title', 'Reset Password - Pustaka Nusa')
    <title>@yield('title', 'Pustaka Nusa')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa; font-family: Arial, sans-serif; padding: 20px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title text-center mb-4">Reset Password</h4>
                        <p class="mb-3">Haii, <strong>{{ $username }}</strong></p>
                        <p>Kami telah menerima permintaan untuk mereset password Anda. Klik tombol di bawah ini untuk melanjutkan proses reset password:</p>
                        <div class="text-center my-3">
                            <a href="{{ $reset_link }}" class="btn btn-primary" style="text-decoration: none; padding: 10px 20px;">Reset Password</a>
                        </div>
                        <p class="mb-0">Atau salin dan tempel link berikut di browser Anda:</p>
                        <p class="text-muted" style="word-wrap: break-word;">{{ $reset_link }}</p>
                    </div>
                </div>
                <p class="text-center mt-4 text-muted">Jika Anda tidak merasa melakukan permintaan ini, abaikan saja email ini.</p>
            </div>
        </div>
    </div>
</body>
</html>

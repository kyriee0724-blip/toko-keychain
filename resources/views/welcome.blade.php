<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Selamat Datang - Sertifikasi Data Toko Keychain</title>

        <!-- Framework CSS Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light d-flex align-items-center justify-content-center vh-100">

        <div class="text-center p-5 bg-white shadow-sm rounded-4" style="max-width: 600px; width: 100%;">
            <h1 class="fw-bold text-primary mb-3">🔑 Toko Keychain</h1>
            
            <!-- Penjelasan Selamat Datang -->
            <p class="text-muted mb-4 fs-5">
                Selamat datang disini adalah web sertifikasi toko keychain. Silakan klik tombol di bawah untuk melanjutkan ke halaman login.
            </p>
            
            <!-- Tombol Selanjutnya yang mengarah ke Login -->
            <div class="d-grid gap-2 col-8 mx-auto">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 py-2">
                    Selanjutnya &rarr;
                </a>
            </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
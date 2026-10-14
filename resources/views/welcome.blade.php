<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikasi Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">Sertifikasi Data</a>

        <div class="d-flex align-items-center gap-3 text-white">
            @auth
                <span>{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Daftar</a>
            @endauth
        </div>
    </div>
</nav>

<div class="container py-5">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="text-center mb-5">
        <h1 class="fw-bold">Sertifikasi Data</h1>
        <p class="text-secondary">
            Website untuk pendataan peserta dan pengelolaan skema sertifikasi.
        </p>

        @auth
            <h5 class="mt-4">Selamat datang, {{ auth()->user()->name }}!</h5>
            <p>Silakan pilih menu yang ingin Anda buka.</p>
        @else
            <p>Silakan login untuk melihat data sertifikasi.</p>
        @endauth
    </div>

    <div class="row g-4 justify-content-center">

        <div class="col-md-5">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4 text-center">
                    <h4 class="fw-bold">Data Peserta</h4>
                    <p class="text-secondary">
                        Lihat informasi peserta sertifikasi yang terdaftar.
                    </p>

                    @auth
                        <a href="{{ auth()->user()->role === 'admin'
                            ? route('admin.participants.index')
                            : route('user.participants.index') }}"
                           class="btn btn-primary">
                            Lihat Data Peserta
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            Login untuk Melihat Data
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4 text-center">
                    <h4 class="fw-bold">Skema Sertifikasi</h4>
                    <p class="text-secondary">
                        Lihat daftar skema sertifikasi yang tersedia.
                    </p>

                    @auth
                        <a href="{{ auth()->user()->role === 'admin'
                            ? route('admin.schemas.index')
                            : route('user.schemas.index') }}"
                           class="btn btn-success">
                            Lihat Skema Sertifikasi
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-success">
                            Login untuk Melihat Skema
                        </a>
                    @endauth
                </div>
            </div>
        </div>

    </div>

</div>

<footer class="text-center text-secondary py-4">
    &copy; {{ date('Y') }} Sertifikasi Data
</footer>

</body>
</html>
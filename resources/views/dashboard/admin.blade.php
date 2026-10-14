<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Sertifikasi Data</title>
    <!-- Menggunakan Bootstrap 5 untuk styling yang rapi -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar Admin -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">🔑 Admin Panel - Sertifikasi Data</a>
            <div class="d-flex align-items-center">
                <span class="text-white me-3 small">Halo, Admin <strong>{{ $user->name }}</strong></span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">Keluar</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Konten Utama Dashboard Admin -->
    <div class="container py-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row mb-4">
            <div class="col-md-12">
                <h2 class="fw-bold">Dashboard Administrator</h2>
                <p class="text-muted">Kelola skema sertifikasi dan data peserta secara penuh dari panel ini.</p>
            </div>
        </div>

        <!-- Kotak Statistik Ringkas -->
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 bg-primary text-white">
                    <div class="card-body p-4">
                        <h5 class="card-title text-uppercase small fw-bold">Total Peserta Terdaftar</h5>
                        <h2 class="display-5 fw-bold mb-0">{{ $totalPeserta ?? 0 }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 bg-success text-white">
                    <div class="card-body p-4">
                        <h5 class="card-title text-uppercase small fw-bold">Total Skema Sertifikasi</h5>
                        <h2 class="display-5 fw-bold mb-0">{{ $totalSkema ?? 0 }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Menu Akses Cepat Admin -->
        <div class="row g-3">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 p-3">
                    <div class="card-body">
                        <h4 class="fw-bold mb-2">Manajemen Skema</h4>
                        <p class="text-muted small">Tambah, edit, atau hapus daftar skema sertifikasi toko keychain.</p>
                    <a href="{{ route('admin.schemas.index') }}" class="btn btn-dark w-100">Kelola Skema</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 p-3">
                    <div class="card-body">
                        <h4 class="fw-bold mb-2">Manajemen Peserta</h4>
                        <p class="text-muted small">Kelola data seluruh peserta, tambah peserta baru, atau hapus data.</p>
                        <a href="{{ route('admin.participants.index') }}" class="btn btn-dark w-100">Kelola Peserta</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
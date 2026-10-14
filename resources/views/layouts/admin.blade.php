<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Sertifikasi</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="d-flex" style="min-height: 100vh;">
        
        <!-- SIDEBAR NAVIGASI ADMIN -->
        <div class="bg-dark text-white p-3 d-flex flex-column flex-shrink-0" style="width: 260px;">
            <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-5 fw-bold">🛠️ Admin Panel</span>
            </a>
            <hr class="text-secondary">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item mb-1">
                    <a href="{{ route('schemas.index') }}" class="nav-link text-white">📁 Kelola Skema</a>
                </li>
                <li class="nav-item mb-1">
                    <a href="{{ route('participants.index') }}" class="nav-link active bg-primary text-white">👥 Kelola Peserta</a>
                </li>
            </ul>
            <hr class="text-secondary">
            
            <!-- Tombol Logout -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger w-100">🚪 Logout</button>
            </form>
        </div>

        <!-- KONTEN UTAMA -->
        <div class="flex-grow-1 d-flex flex-column">
            <!-- Navbar Atas -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4">
                <span class="navbar-brand mb-0 h1">Sistem Manajemen Data Sertifikasi</span>
                <div class="ms-auto text-secondary text-sm">
                    Login sebagai: <strong class="text-dark">{{ auth()->user()->name ?? 'Admin' }}</strong>
                </div>
            </nav>

            <!-- Tempat Menampilkan Konten dari View Lain -->
            <div class="p-4 flex-grow-1 overflow-auto">
                @yield('content')
            </div>
        </div>

    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peserta - Sertifikasi</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

    <!-- Navbar Atas -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">🔑 Sertifikasi Data - User Area</a>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">Keluar (Logout)</button>
            </form>
        </div>
    </nav>

    <!-- Container Utama -->
    <div class="container my-auto py-5" style="max-width: 900px;">
        
        <!-- Notifikasi Sukses -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Header Judul -->
        <div class="mb-4">
            <h2 class="fw-bold text-secondary">Dashboard Peserta</h2>
            <p class="text-muted mb-0">Informasi data peserta sertifikasi Anda.</p>
        </div>

        <!-- Card Data Peserta -->
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-4 p-md-5 position-relative">
                
                <!-- Badge Status di Pojok Kanan Atas -->
                <div class="position-absolute top-0 end-0 m-4">
                    <span class="badge bg-light text-secondary border px-3 py-2 fw-normal">
                        {{ $user->status ?? 'Terdaftar' }}
                    </span>
                </div>

                <h4 class="fw-bold mb-4 pb-2 border-bottom text-dark">Data Peserta Saya</h4>

                <!-- Grid Data 2 Kolom -->
                <div class="row g-4 mb-5">
                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">Nama Lengkap</small>
                        <span class="fw-semibold text-dark fs-5">{{ $user->name ?? '-' }}</span>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">NIK</small>
                        <span class="fw-semibold text-dark fs-5">{{ $user->nik ?? '-' }}</span>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">Email</small>
                        <span class="fw-semibold text-dark">{{ $user->email ?? '-' }}</span>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">Nomor HP</small>
                        <span class="fw-semibold text-dark">{{ $user->phone ?? '-' }}</span>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">Jenis Kelamin</small>
                        <span class="fw-semibold text-dark">{{ $user->gender ?? '-' }}</span>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">Alamat</small>
                        <span class="fw-semibold text-dark">{{ $user->address ?? '-' }}</span>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">Tanggal Pendaftaran</small>
                        <span class="fw-semibold text-dark">
                            {{ $user->created_at ? $user->created_at->format('d-m-Y') : date('d-m-Y') }}
                        </span>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">Status Peserta</small>
                        <span class="fw-semibold text-dark">{{ $user->status ?? 'Terdaftar' }}</span>
                    </div>
                </div>

                <!-- Tombol Aksi di Bawah -->
                <div class="d-flex justify-content-end align-items-center pt-3 border-top">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary px-4">
                        Edit Data Saya
                    </a>
                </div>

            </div>
        </div>

        <!-- Footer Hak Cipta -->
        <footer class="text-center text-muted mt-4 small">
            &copy; 2026 Sertifikasi App. All Rights Reserved.
        </footer>

    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - Sertifikasi Data Toko Keychain</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar User Biasa -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">🔑 Toko Keychain - Area Pengguna</a>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">Keluar</button>
            </form>
        </div>
    </nav>

    <!-- Konten Utama Dashboard User -->
    <div class="container py-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <h3 class="fw-bold mb-2">Profil Data Diri Saya</h3>
                        <p class="text-muted">Selamat datang, <strong>{{ $user->name }}</strong>! Anda masuk sebagai peserta/user biasa.</p>
                        
                        <hr class="my-4">

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label text-muted">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <p class="form-control-plaintext fw-bold">{{ $user->name }}</p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label text-muted">Email</label>
                            <div class="col-sm-9">
                                <p class="form-control-plaintext fw-bold">{{ $user->email }}</p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label text-muted">No. Telepon</label>
                            <div class="col-sm-9">
                                <p class="form-control-plaintext fw-bold">{{ $user->phone ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label text-muted">NIK</label>
                            <div class="col-sm-9">
                                <p class="form-control-plaintext fw-bold">{{ $user->nik ?? '-' }}</p>
                            </div>
                        </div>

                        <!-- Tombol Edit Mandiri Khusus Data Diri Sendiri -->
                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('profile.edit') }}" class="btn btn-warning px-4 text-dark fw-bold">Edit Data Diri Saya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
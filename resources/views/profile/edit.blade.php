<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - Sertifikasi Data</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

    <!-- Navbar Atas -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">🔑 Data Sertifikasi - User Area</a>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">Keluar (Logout)</button>
            </form>
        </div>
    </nav>

    <!-- Container Utama -->
    <div class="container my-auto py-5" style="max-width: 800px;">
        
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-4 p-md-5">
                
                <h3 class="fw-bold mb-1">Edit Data Diri</h3>
                <p class="text-muted mb-4">Perbarui informasi profil dan skema sertifikasi Anda di sini.</p>

                <!-- Notifikasi Error / Sukses -->
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Form Update Profil -->
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label text-muted">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label text-muted">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label text-muted">Nomor Telepon / HP</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="nik" class="form-label text-muted">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" value="{{ old('nik', $user->nik ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label text-muted">Jenis Kelamin</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ (old('gender', $user->gender ?? '') == 'Laki-laki') ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ (old('gender', $user->gender ?? '') == 'Perempuan') ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label text-muted">Alamat</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address', $user->address ?? '') }}</textarea>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary px-4">← Kembali</a>
                        <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                    </div>
                </form>

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
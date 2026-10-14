<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Skema - Data Sertifikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="d-flex" style="min-height: 100vh;">

        <div class="bg-dark text-white p-3 d-flex flex-column flex-shrink-0" style="width: 260px;">
            <a href="#" class="d-flex align-items-center mb-3 text-white text-decoration-none">
                <span class="fs-5 fw-bold">🛠️ Admin Panel</span>
            </a>

            <hr class="text-secondary">

            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item mb-1">
                    <a href="{{ route('admin.schemas.index') }}" class="nav-link active bg-primary text-white">
                        📁 Kelola Skema
                    </a>
                </li>

                <li class="nav-item mb-1">
                    <a href="{{ route('admin.participants.index') }}" class="nav-link text-white">
                        👥 Kelola Peserta
                    </a>
                </li>
            </ul>

            <hr class="text-secondary">

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger w-100">🚪 Logout</button>
            </form>
        </div>

        <div class="flex-grow-1 d-flex flex-column">

            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4">
                <span class="navbar-brand mb-0 h1">Sistem Manajemen Toko Keychain</span>

                <div class="ms-auto text-secondary">
                    Login sebagai:
                    <strong class="text-dark">{{ auth()->user()->name ?? 'Admin' }}</strong>
                </div>
            </nav>

            <div class="p-4 flex-grow-1 overflow-auto">
                <div class="container py-2" style="max-width: 600px;">

                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">

                            <h3 class="fw-bold mb-4">Edit Skema</h3>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('admin.schemas.update', $schema->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="code" class="form-label">Kode Skema</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="code"
                                        name="code"
                                        value="{{ old('code', $schema->code ?? $schema->kode ?? '') }}"
                                        required
                                    >
                                </div>

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Skema</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="name"
                                        name="name"
                                        value="{{ old('name', $schema->name ?? '') }}"
                                        required
                                    >
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea
                                        class="form-control"
                                        id="description"
                                        name="description"
                                        rows="3"
                                    >{{ old('description', $schema->description ?? '') }}</textarea>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.schemas.index') }}" class="btn btn-secondary">
                                        ← Kembali
                                    </a>

                                    <button type="submit" class="btn btn-primary">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
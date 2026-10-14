
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Skema - Data Sertifikasi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="d-flex" style="min-height: 100vh;">

        <!-- SIDEBAR -->
        <div class="bg-dark text-white p-3 d-flex flex-column flex-shrink-0" style="width: 260px;">

            <a href="#" class="d-flex align-items-center mb-3 text-white text-decoration-none">
                <span class="fs-5 fw-bold">🛠️ Admin Panel</span>
            </a>

            <hr class="text-secondary">

            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item mb-1">
                    <a href="{{ route('admin.schemas.index') }}" class="nav-link active text-white">
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
                <button type="submit" class="btn btn-danger w-100">
                    🚪 Logout
                </button>
            </form>

        </div>

        <!-- KONTEN UTAMA -->
        <div class="flex-grow-1 d-flex flex-column">

            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4">
                <span class="navbar-brand mb-0 h1">
                    Sistem Manajemen Data Sertifikasi
                </span>

                <div class="ms-auto text-secondary">
                    Login sebagai:
                    <strong class="text-dark">
                        {{ auth()->user()->name ?? 'Admin' }}
                    </strong>
                </div>
            </nav>

            <div class="p-4 flex-grow-1 overflow-auto">
                <div class="container-fluid py-2">

                    <!-- HEADER -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="fw-bold mb-0">Daftar Skema</h3>

                        @if(auth()->check() && auth()->user()->role == 'admin')
                            <a href="{{ route('admin.schemas.create') }}" class="btn btn-primary">
                                + Tambah Skema
                            </a>
                        @endif
                    </div>

                    <!-- NOTIFIKASI -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                            {{ session('success') }}

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                            {{ session('error') }}

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- TABEL SKEMA -->
                    <div class="card shadow-sm border-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">

                                <thead class="table-dark">
                                    <tr>
                                        <th style="width: 120px;">Kode</th>
                                        <th>Nama Skema</th>
                                        <th>Deskripsi</th>
                                        <th style="width: 140px;" class="text-center">Jumlah Peserta</th>
                                        <th style="width: 180px;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($schemas as $s)
                                        <tr>
                                            <td class="fw-bold">
                                                {{ $s->code ?? $s->kode ?? '-' }}
                                            </td>

                                            <td>
                                                {{ $s->name ?? '-' }}
                                            </td>

                                            <td>
                                                {{ $s->description ?? '-' }}
                                            </td>

                                            <td class="text-center">
                                                <span class="badge bg-info text-dark">
                                                    {{ $s->participants_count ?? 0 }} Peserta
                                                </span>
                                            </td>

                                            <td>
                                                <a href="{{ route('admin.schemas.edit', $s->id) }}"
                                                   class="btn btn-sm btn-warning text-white">
                                                    Edit
                                                </a>

                                                <form action="{{ route('admin.schemas.destroy', $s->id) }}"
                                                      method="POST"
                                                      class="d-inline"
                                                      onsubmit="return confirm('Yakin ingin menghapus skema ini?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-3 text-muted">
                                                Data skema belum tersedia.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>
                    </div>

                    <!-- PAGINATION -->
                    @if(method_exists($schemas, 'links'))
                        <div class="mt-3">
                            {{ $schemas->links() }}
                        </div>
                    @endif

                    <!-- TOMBOL KEMBALI -->
                    <div class="mt-3">
                        <a href="{{ url('/') }}" class="btn btn-secondary">
                            ← Kembali
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

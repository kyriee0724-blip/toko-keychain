<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Skema - Sertifikasi Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark shadow-sm px-4">
    <a href="{{ route('dashboard') }}" class="navbar-brand fw-bold">
        Sertifikasi Data
    </a>

    <div class="text-white">
        {{ auth()->user()->name }}
        <form action="{{ route('logout') }}" method="POST" class="d-inline ms-2">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm">Logout</button>
        </form>
    </div>
</nav>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Daftar Skema Sertifikasi</h3>
    </div>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 60px;">No.</th>
                        <th>Kode Skema</th>
                        <th>Nama Skema</th>
                        <th>Deskripsi</th>
                        <th>Jumlah Peserta</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($schemas as $key => $schema)
                        <tr>
                            <td>{{ ($schemas->firstItem() ?? 1) + $key }}</td>
                            <td>{{ $schema->code }}</td>
                            <td>{{ $schema->name }}</td>
                            <td>{{ $schema->description ?? '-' }}</td>
                            <td>
                                <span class="badge bg-primary">
                                    {{ $schema->participants_count }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Belum ada data skema sertifikasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-end mt-3">
        {{ $schemas->links() }}
    </div>

    <div class="mt-3">
    <a href="/" class="btn btn-secondary">
        ← Kembali ke Panel Admin
    </a>
</div>
</div>

</body>
</html>
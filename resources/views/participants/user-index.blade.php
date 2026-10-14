<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peserta - Sertifikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar bg-white shadow-sm px-4">
    <span class="navbar-brand fw-bold">Sistem Manajemen Data Sertifikasi</span>
    <span class="text-secondary">
        Login sebagai: <strong>{{ auth()->user()->name }}</strong>
    </span>
</nav>

<div class="container py-4">
    <h3 class="fw-bold mb-3">Daftar Peserta</h3>

    <form action="{{ route('user.participants.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control"
                   placeholder="Cari nama atau email..."
                   value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>

            @if(request('search'))
                <a href="{{ route('user.participants.index') }}"
                   class="btn btn-secondary">Reset</a>
            @endif
        </div>
    </form>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Alamat</th>
                        <th>Skema</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($participants as $key => $participant)
                        <tr>
                            <td>{{ ($participants->firstItem() ?? 1) + $key }}</td>
                            <td>{{ $participant->name }}</td>
                            <td>{{ $participant->email }}</td>
                            <td>{{ $participant->phone ?? '-' }}</td>
                            <td>{{ $participant->address ?? '-' }}</td>
                            <td>{{ $participant->schema->name ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-3">
                                Data peserta belum tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-end mt-3">
        {{ $participants->appends(request()->query())->links() }}
    </div>

    <div class="mt-4">
        <a href="/" class="btn btn-secondary">
            ← Kembali ke Dashboard
        </a>
    </div>
</div>

</body>
</html>
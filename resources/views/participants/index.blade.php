<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Peserta - Sertifikasi Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand fw-bold">Sertifikasi Data</a>
        <a href="{{ url('/') }}" class="btn btn-outline-light btn-sm">Kembali</a>
    </div>
</nav>

<div class="container py-4">

    <h2 class="fw-bold mb-4">Daftar Peserta</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('admin.participants.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control"
                   placeholder="Cari nama atau email peserta..."
                   value="{{ $search ?? '' }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>

    <a href="{{ route('admin.participants.create') }}" class="btn btn-success mb-3">
        + Tambah Peserta
    </a>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. HP</th>
                            <th>Alamat</th>
                            <th>Skema</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($participants as $participant)
                            <tr>
                                <td>{{ $participants->firstItem() + $loop->index }}</td>
                                <td>{{ $participant->name }}</td>
                                <td>{{ $participant->email }}</td>
                                <td>{{ $participant->phone }}</td>
                                <td>{{ $participant->address ?? '-' }}</td>
                                <td>{{ $participant->schema->name ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.participants.edit', $participant->id) }}"
                                       class="btn btn-warning btn-sm">Edit</a>

                                    <form action="{{ route('admin.participants.destroy', $participant->id) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus peserta ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    Data peserta belum tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $participants->links() }}
        </div>
    </div>

</div>

</body>
</html>

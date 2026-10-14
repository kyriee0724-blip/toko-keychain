<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peserta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <!-- Header Halaman & Tombol Tambah Peserta (Khusus Admin) -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold mb-0">Daftar Peserta</h3>
        @if(auth()->check() && auth()->user()->role == 'admin')
            <a href="{{ route('participants.create') }}" class="btn btn-primary">+ Tambah Peserta</a>
        @endif
    </div>

    <!-- Form Pencarian -->
    <form action="{{ route('participants.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari nama atau email..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary bg-white text-dark" type="submit">Cari</button>
        </div>
    </form>

    <!-- Notifikasi Sukses -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tabel Daftar Peserta -->
    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Skema</th>
                        <th style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($participants as $participant)
                        <tr>
                            <!-- Menggunakan penomoran dinamis yang mendukung pagination -->
                            <td>{{ $loop->iteration + ($participants->currentPage() - 1) * $participants->perPage() }}</td>
                            <td>{{ $participant->name }}</td>
                            <td>{{ $participant->email }}</td>
                            <td>{{ $participant->address ?? '-' }}</td>
                            <td>{{ $participant->schema->name ?? '-' }}</td>
                            <td>
                                <!-- Tombol Detail Peserta (Bisa dilihat semua user) -->
                                <a href="{{ route('participants.show', $participant->id) }}" class="btn btn-sm btn-info text-white">Detail</a>
                                
                                <!-- Tombol Edit & Hapus (Khusus Admin) -->
                                @if(auth()->check() && auth()->user()->role == 'admin')
                                    <a href="{{ route('participants.edit', $participant->id) }}" class="btn btn-sm btn-warning text-white">Edit</a>
                                    
                                    <form action="{{ route('participants.destroy', $participant->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-3 text-muted">Data peserta belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Links Pagination -->
    <div class="d-flex justify-content-end mt-3">
        {{ $participants->appends(request()->query())->links() }}
    </div>

    <!-- Tombol Kembali -->
    <div class="mt-3">
        <a href="{{ url('/') }}" class="btn btn-secondary">← Kembali</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
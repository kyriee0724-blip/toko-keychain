<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Skema - Toko Keychain</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Skema</h2>
        <a href="{{ route('schemas.create') }}" class="btn btn-primary">
            + Tambah Skema
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">

                <thead class="table-dark">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Skema</th>
                        <th>Deskripsi</th>
                        <th>Jumlah Peserta</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($schemas as $s)

                        <tr>

                            <td>
                                <strong>{{ $s->code }}</strong>
                            </td>

                            <td>
                                {{ $s->name }}
                            </td>

                            <td>
                                {{ $s->description ?? '-' }}
                            </td>

                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ $s->participants_count }} Peserta
                                </span>
                            </td>

                            <td>

                                <a
                                    href="{{ route('schemas.edit', $s->id) }}"
                                    class="btn btn-sm btn-warning"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('schemas.destroy', $s->id) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus skema ini?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn btn-sm btn-danger"
                                        type="submit"
                                    >
                                        Hapus
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center py-3">
                                Belum ada data skema.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $schemas->links() }}
    </div>

    {{-- Tombol Kembali --}}
    <div class="mt-4">
        <button
            type="button"
            class="btn btn-secondary"
            onclick="history.back()"
        >
            ← Kembali
        </button>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peserta - Sertifikasi Data Toko Keychain</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Peserta</h2>

        <a href="{{ route('participants.create') }}" class="btn btn-primary">
            + Tambah Peserta
        </a>
    </div>

    {{-- Form Pencarian --}}
    <form action="{{ route('participants.index') }}" method="GET" class="mb-4">
        <div class="input-group">

            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Cari nama atau email..."
                value="{{ $search ?? '' }}"
            >

            <button class="btn btn-outline-secondary bg-white text-dark" type="submit">
                Cari
            </button>

        </div>
    </form>

    {{-- Tabel Peserta --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">

            <table class="table table-striped table-hover mb-0 align-middle">

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

                    @forelse ($participants as $key => $p)

                        <tr>

                            <td>
                                {{ $participants->firstItem() + $key }}
                            </td>

                            <td>
                                {{ $p->name }}
                            </td>

                            <td>
                                {{ $p->email }}
                            </td>

                            <td>
                                {{ $p->address ?? '-' }}
                            </td>

                            <td>
                                {{ $p->schema->name ?? '-' }}
                            </td>

                            <td>

                                {{-- Tombol Detail --}}
                                <a
                                    href="{{ route('participants.show', $p->id) }}"
                                    class="btn btn-sm btn-info text-white me-1"
                                >
                                    Detail
                                </a>

                                {{-- Tombol Edit --}}
                                <a
                                    href="{{ route('participants.edit', $p->id) }}"
                                    class="btn btn-sm btn-warning text-white me-1"
                                >
                                    Edit
                                </a>

                                {{-- Tombol Hapus --}}
                                <form
                                    action="{{ route('participants.destroy', $p->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus peserta ini?');"
                                    class="d-inline"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-danger"
                                    >
                                        Hapus
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center py-3 text-muted">
                                Tidak ada data peserta.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-3 d-flex justify-content-end">
        {{ $participants->appends(['search' => $search])->links() }}
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
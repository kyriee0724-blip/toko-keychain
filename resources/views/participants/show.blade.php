<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Peserta - {{ $participant->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-sm border-0">
                <!-- Header Kartu -->
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 fw-bold">Detail Peserta</h5>
                    <a href="{{ route('participants.index') }}" class="btn btn-sm btn-light">← Kembali</a>
                </div>

                <!-- Bodi Kartu -->
                <div class="card-body p-4">
                    <table class="table table-borderless align-middle mb-0">
                        <tbody>
                            <tr>
                                <th style="width: 35%;" class="text-secondary fw-semibold">Nama Lengkap</th>
                                <td style="width: 5%;">:</td>
                                <td class="fw-bold fs-5 text-dark">{{ $participant->name }}</td>
                            </tr>
                            <tr>
                                <th class="text-secondary fw-semibold">Email</th>
                                <td>:</td>
                                <td>{{ $participant->email }}</td>
                            </tr>
                            <tr>
                                <th class="text-secondary fw-semibold">Nomor Telepon</th>
                                <td>:</td>
                                <td>{{ $participant->phone ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-secondary fw-semibold">Skema</th>
                                <td>:</td>
                                <td>
                                    <span class="badge bg-info text-dark fs-6 fw-normal">
                                        {{ $participant->schema->name ?? '-' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-secondary fw-semibold align-top">Alamat Lengkap</th>
                                <td class="align-top">:</td>
                                <td class="align-top text-break">
                                    {{ $participant->address ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <th class="text-secondary fw-semibold">Tanggal Terdaftar</th>
                                <td>:</td>
                                <td>{{ $participant->created_at ? $participant->created_at->format('d M Y H:i') : '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Footer Kartu dengan Tombol Aksi -->
                <div class="card-footer bg-white border-0 text-end pb-4 pe-4">
                    <a href="{{ route('participants.edit', $participant->id) }}" class="btn btn-warning text-white me-2">
                        Edit Data
                    </a>
                    <a href="{{ route('participants.index') }}" class="btn btn-secondary">
                        Tutup
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
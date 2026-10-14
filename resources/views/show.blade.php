<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Peserta</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        .card { border: 1px solid #fc5dcc; padding: 20px; border-radius: 6px; max-width: 500px; }
    </style>
</head>
<body>

    <h2>Detail Data Peserta</h2>

    <div class="card">
        <p><strong>Nama:</strong> {{ $participant->name }}</p>
        <p><strong>Email:</strong> {{ $participant->email }}</p>
        <p><strong>No HP:</strong> {{ $participant->phone }}</p>
        <p><strong>Alamat:</strong> {{ $participant->address }}</p>
        <hr>
        <p><strong>Kode Skema:</strong> {{ $participant->schema->code ?? '-' }}</p>
        <p><strong>Nama Skema:</strong> {{ $participant->schema->name ?? '-' }}</p>
    </div>

    <br>
    <a href="{{ route('participants.index') }}">← Kembali ke Daftar Peserta</a>

</body>
</html>
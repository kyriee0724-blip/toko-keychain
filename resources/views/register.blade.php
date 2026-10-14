<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Toko Keychain</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh; 
            background-color: #f4f6f9; 
            margin: 0;
        }
        .register-box { 
            width: 360px; 
            padding: 20px; 
            background: white; 
            border-radius: 6px; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
        }
        .form-group { 
            margin-bottom: 15px; 
        }
        label { 
            display: block; 
            margin-bottom: 5px; 
            font-size: 14px;
        }
        input { 
            width: 100%; 
            padding: 8px; 
            box-sizing: border-box; 
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .text-danger {
            color: red;
            font-size: 12px;
            margin-top: 3px;
            display: block;
        }
        button { 
            width: 100%; 
            padding: 10px; 
            background: #e287bf; 
            color: white; 
            border: none; 
            border-radius: 4px; 
            cursor: pointer; 
        }
        button:hover {
            background: #d074ab;
        }
    </style>
</head>
<body>

    <div class="register-box">
        <h3 style="text-align: center;">Register Toko Keychain</h3>

        <form action="{{ route('register.store') }}" method="POST">
            @csrf

            <!-- Nama -->
            <div class="form-group">
                <label for="name">Nama Lengkap (Tanpa Angka):</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
    <label for="gender" class="form-label">Jenis Kelamin</label>
    <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" required>
        <option value="">-- Pilih Jenis Kelamin --</option>
        <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
        <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
    </select>
    @error('gender')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

            <!-- No Telepon -->
            <div class="form-group">
                <label for="phone">No Telepon (Maks. 11 digit):</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required>
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- NIK -->
            <div class="form-group">
                <label for="nik">NIK (Harus 16 digit):</label>
                <input type="text" id="nik" name="nik" value="{{ old('nik') }}" required>
                @error('nik')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>

            <button type="submit">Daftar Sekarang</button>
        </form>

        <p style="text-align: center; margin-top: 15px; font-size: 13px;">
            Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
        </p>
    </div>

</body>
</html>
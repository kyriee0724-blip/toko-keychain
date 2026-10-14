<!DOCTYPE html>
<html lang="id">
<head>
    <!-- Pengaturan Karakter & Responsivitas Viewport -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sertifikasi Data Toko Keychain</title>

    <!-- CSS Internal untuk Tampilan Halaman Login -->
    <style>
        /* Mengatur tata letak halaman agar form berada persis di tengah layar */
        body { 
            font-family: Arial, sans-serif; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            background-color: #f4f6f9; 
            margin: 0;
        }

        /* Container utama kotak form login */
        .login-box { 
            width: 340px; 
            padding: 20px; 
            background: white; 
            border-radius: 6px; 
            box-shadow: 0 0 10px rgba(243, 139, 200, 0.1); 
        }


        /* Jarak antar elemen input */
        .form-group { 
            margin-bottom: 15px; 
        }

        /* Label untuk field input */
        label { 
            display: block; 
            margin-bottom: 5px; 
        }

        /* Styling field input teks dan password */
        input { 
            width: 100%; 
            padding: 8px; 
            box-sizing: border-box; 
            border: 1px solid #f03e3e;
            border-radius: 4px;
        }

        /* Styling tombol submit login */
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
            background: #d074ac;
        }

        /* Kotak Peringatan Error */
        .alert-error {
            background-color: #f8d7da;
            color: #e43c98;
            padding: 10px;
            border-radius: 4px;
            font-size: 13px;
            margin-bottom: 15px;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>

    <!-- Container Form Login -->
    <div class="login-box">
        <!-- Judul Halaman -->
        <h3 style="text-align: center; margin-bottom: 20px;">Login Toko Keychain</h3>

        <!-- KETERANGAN / PESAN ERROR JIKA EMAIL ATAU PASSWORD SALAH -->
        @if ($errors->any())
            <div class="alert-error">
                <strong>Gagal Masuk!</strong> Email atau password yang Anda masukkan salah. Silakan periksa kembali.
            </div>
        @endif

        <!-- Form Autentikasi Login Laravel -->
        <form action="{{ route('login') }}" method="POST">
            <!-- Token Keamanan CSRF Laravel (Wajib untuk Method POST) -->
            @csrf

            <!-- Input Alamat Email -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>

            <!-- Input Kata Sandi / Password -->
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <!-- Tombol untuk Memproses Login -->
            <button type="submit">Masuk</button>
        </form>
    </div>

</body>
</html>
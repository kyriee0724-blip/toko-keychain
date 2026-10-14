<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sertifikasi Data</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f6f9;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        .login-box {
            width: 340px;
            max-width: 100%;
            padding: 20px;
            background: white;
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(243, 139, 200, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #f03e3e;
            border-radius: 4px;
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
            background: #d074ac;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #e43c98;
            padding: 10px;
            border-radius: 4px;
            font-size: 13px;
            margin-bottom: 15px;
            border: 1px solid #f5c6cb;
        }

        .back-button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 12px;
            box-sizing: border-box;
            background: #6c757d;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }

        .back-button:hover {
            background: #565e64;
        }
    </style>
</head>
<body>

    <div class="login-box">
        <h3 style="text-align: center; margin-bottom: 20px;">
            Login Toko Keychain
        </h3>

        @if ($errors->any())
            <div class="alert-error">
                <strong>Gagal Masuk!</strong>
                Email atau password yang Anda masukkan salah.
                Silakan periksa kembali.
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Email:</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                >
            </div>

            <button type="submit">Masuk</button>
        </form>

        <a href="{{ url('/') }}" class="back-button">
            ← Kembali ke Welcome
        </a>
    </div>

</body>
</html>
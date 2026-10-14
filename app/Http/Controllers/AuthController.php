<?php

namespace App\Http\Controllers;

// Digunakan untuk menerima data dari form
use Illuminate\Http\Request;

// Digunakan untuk proses login dan logout
use Illuminate\Support\Facades\Auth;

// Import Model User (Pastikan model User sudah ada)
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Menampilkan form login
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Memproses otentikasi/login user
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', 'Selamat datang kembali!');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Menampilkan form register
     */
    public function showRegisterForm()
    {
        return view('register'); // Pastikan file view register.blade.php ada di resources/views/register.blade.php
    }

    /**
     * Memproses pendaftaran user baru
     */
    public function register(Request $request)
    {
        // Validasi input sesuai permintaan
        $request->validate([
            'name'  => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'numeric', 'digits_between:1,11'],
            'nik'   => ['required', 'numeric', 'digits:16'],
            'password' => ['required', 'string', 'min:3'],
        ], [
            // Pesan error kustom sesuai permintaan aku
            'name.regex'           => 'Nama tidak boleh diisi angka!',
            'phone.numeric'        => 'No telp harus berupa angka.',
            'phone.digits_between' => 'No telp gaboleh lebih dr 11!',
            'nik.numeric'          => 'NIK harus berupa angka.',
            'nik.digits'           => 'Nik gaboleh lebih dan ga boleh kurang dr 16!',
        ]);

        // Simpan data ke database
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'nik'      => $request->nik,
            'password' => Hash::make($request->password),
            'role'     => 'user', // Otomatis memberikan role user pada akun yang mendaftar
        ]);

        // Validasi data inputan termasuk gender
    $request->validate([
        'name'     => ['required', 'string', 'max:255'],
        'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:3'],
        'gender'   => ['required', 'in:Laki-laki,Perempuan'], // Tambahan validasi gender
    ]);

    // Simpan data user baru ke database
    $user = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'gender'   => $request->gender, // Simpan gender
        'role'     => 'user', // Default sebagai user biasa
    ]);

        // Redirect ke halaman login dengan pesan sukses
        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * Memproses logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah berhasil keluar dari sistem.');
    }
}
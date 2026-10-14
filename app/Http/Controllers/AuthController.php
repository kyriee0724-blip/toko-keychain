<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard')
                ->with('success', 'Login berhasil!');
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password salah.',
            ])
            ->onlyInput('email');
    }

    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s]+$/',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'gender' => [
                'required',
                'in:Laki-laki,Perempuan',
            ],
            'phone' => [
                'required',
                'numeric',
                'digits_between:1,11',
            ],
            'nik' => [
                'required',
                'numeric',
                'digits:16',
            ],
            'password' => [
                'required',
                'string',
                'min:3',
            ],
        ], [
            'name.regex' => 'Nama tidak boleh diisi angka!',
            'phone.numeric' => 'Nomor telepon harus berupa angka.',
            'phone.digits_between' => 'Nomor telepon maksimal 11 digit.',
            'nik.numeric' => 'NIK harus berupa angka.',
            'nik.digits' => 'NIK harus tepat 16 digit.',
            'gender.required' => 'Jenis kelamin harus dipilih.',
            'gender.in' => 'Pilihan jenis kelamin tidak valid.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'nik' => $request->nik,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'Registrasi berhasil! Silakan login.');
    }

   public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('welcome');
}
}
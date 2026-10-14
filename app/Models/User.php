<?php

namespace App\Models;

// Digunakan agar model dapat menggunakan fitur Factory
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Digunakan agar User dapat melakukan proses autentikasi/login
use Illuminate\Foundation\Auth\User as Authenticatable;

// Digunakan untuk fitur notifikasi pada User
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $nik
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class User extends Authenticatable
{
    // Mengaktifkan fitur Factory dan Notifiable pada model User
    use HasFactory, Notifiable;

    // Menentukan field yang boleh diisi secara massal
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'nik',
        'gender',
        'role', 
    ];

    // Menentukan data yang tidak boleh ditampilkan atau diambil
    // ketika data User diubah menjadi array atau JSON
    protected $hidden = [
        // Menyembunyikan password demi keamanan
        'password',

        // Menyembunyikan token untuk fitur remember me
        'remember_token',
    ];

    // Menentukan tipe data untuk beberapa atribut User
    protected function casts(): array
    {
        return [
            // Mengubah email_verified_at menjadi tipe data datetime
            'email_verified_at' => 'datetime',

            // Mengubah password menjadi bentuk hash secara otomatis
            'password' => 'hashed',
        ];
    }
}
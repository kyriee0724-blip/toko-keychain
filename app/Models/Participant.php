<?php

namespace App\Models;

// Digunakan agar model dapat menggunakan fitur Factory
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Menggunakan Model dari Laravel Eloquent
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    // Mengaktifkan fitur HasFactory pada model
    use HasFactory;

    // Menentukan field yang boleh diisi secara massal
    protected $fillable = [
        // ID dari skema yang diikuti peserta
        'schema_id',

        // Nama peserta
        'name',

        // Email peserta
        'email',

        // Nomor telepon peserta
        'phone',

        // Alamat peserta
        'address',
    ];

    // Relasi kebalikannya: Setiap Peserta terikat pada 1 Skema
    public function schema()
    {
        // belongsTo menunjukkan bahwa setiap peserta
        // hanya memiliki atau terikat pada satu skema
        return $this->belongsTo(Schema::class);
    }
}
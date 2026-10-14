<?php

namespace App\Models;

// Digunakan agar model dapat menggunakan fitur Factory
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Menggunakan Model dari Laravel Eloquent
use Illuminate\Database\Eloquent\Model;

class Schema extends Model
{
    // Mengaktifkan fitur HasFactory pada model
    use HasFactory;

    // Menentukan field yang boleh diisi secara massal
    protected $fillable = [
        // Kode dari skema
        'code',

        // Nama skema
        'name',

        // Deskripsi dari skema
        'description',
    ];

    // Relasi antara Schema dengan Participant
    public function participants()
    {
        // hasMany menunjukkan bahwa satu skema
        // dapat memiliki banyak peserta
        return $this->hasMany(Participant::class);
    }
}
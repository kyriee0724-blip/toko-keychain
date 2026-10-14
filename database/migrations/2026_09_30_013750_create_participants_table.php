<?php

// Menggunakan class Migration untuk membuat perubahan pada database
use Illuminate\Database\Migrations\Migration;

// Digunakan untuk membuat struktur tabel
use Illuminate\Database\Schema\Blueprint;

// Digunakan untuk mengakses dan mengatur tabel database
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        
    // Membuat tabel participants untuk menyimpan data peserta
    Schema::create('participants', function (Blueprint $table) {

    // Membuat ID sebagai primary key
    $table->id();

    // Membuat relasi dengan tabel schemas melalui schema_id
    // onDelete('cascade') berarti data peserta akan ikut terhapus
    // jika data schema yang terkait dihapus
    $table->foreignId('schema_id')->constrained('schemas')->onDelete('cascade'); // Relasi ke schemas

    // Menyimpan nama peserta
    $table->string('name');

    // Menyimpan email peserta dan harus unik
    $table->string('email')->unique();

    // Menyimpan nomor telepon peserta
    $table->string('phone');

    // Menyimpan alamat peserta
    $table->text('address');

    // Membuat kolom created_at dan updated_at
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus tabel participants jika tabel tersebut ada
        Schema::dropIfExists('participants');
    }
};
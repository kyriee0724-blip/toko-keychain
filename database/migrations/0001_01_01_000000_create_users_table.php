<?php

// Menggunakan class Migration untuk membuat perubahan pada database
use Illuminate\Database\Migrations\Migration;

// Digunakan untuk membuat struktur tabel database
use Illuminate\Database\Schema\Blueprint;

// Digunakan untuk mengakses dan mengatur tabel database
use Illuminate\Support\Facades\Schema;

// Membuat migration baru
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Membuat tabel users untuk menyimpan data pengguna
        Schema::create('users', function (Blueprint $table) {

            // Membuat ID sebagai primary key
            $table->id();

            // Membuat kolom nama pengguna
            $table->string('name');

            // Membuat kolom email yang harus unik
            $table->string('email')->unique();

            // Menyimpan waktu ketika email berhasil diverifikasi
            // nullable berarti boleh kosong
            $table->timestamp('email_verified_at')->nullable();

            // Membuat kolom untuk menyimpan password
            $table->string('password');

            // Membuat token untuk fitur "remember me"
            $table->rememberToken();

            // Membuat kolom created_at dan updated_at
            $table->timestamps();
        });

        // Membuat tabel password_reset_tokens
        // untuk menyimpan token ketika user melakukan reset password
        Schema::create('password_reset_tokens', function (Blueprint $table) {

            // Email menjadi primary key
            $table->string('email')->primary();

            // Menyimpan token reset password
            $table->string('token');

            // Menyimpan waktu token dibuat
            // nullable berarti boleh kosong
            $table->timestamp('created_at')->nullable();
        });

        // Membuat tabel sessions untuk menyimpan data session user
        Schema::create('sessions', function (Blueprint $table) {

            // ID session sebagai primary key
            $table->string('id')->primary();

            // ID user yang sedang menggunakan session
            // nullable berarti session dapat berjalan tanpa user
            $table->foreignId('user_id')->nullable()->index();

            // Menyimpan alamat IP pengguna
            $table->string('ip_address', 45)->nullable();

            // Menyimpan informasi browser atau perangkat pengguna
            $table->text('user_agent')->nullable();

            // Menyimpan data session
            $table->longText('payload');

            // Menyimpan waktu terakhir session digunakan
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus tabel users jika tabel tersebut ada
        Schema::dropIfExists('users');

        // Menghapus tabel password_reset_tokens jika ada
        Schema::dropIfExists('password_reset_tokens');

        // Menghapus tabel sessions jika ada
        Schema::dropIfExists('sessions');
    }
};
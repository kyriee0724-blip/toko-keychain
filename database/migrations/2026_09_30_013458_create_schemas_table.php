<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schemas', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Kode Skema (misal: SKM-AKR)
            $table->string('name');          // Nama Skema (misal: Skema Keychain Akrilik)
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schemas');
    }
};
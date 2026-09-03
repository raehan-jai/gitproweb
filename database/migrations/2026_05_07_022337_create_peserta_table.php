<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peserta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kegiatan_id')          // Relasi ke tabel kegiatan
                  ->constrained('kegiatan')
                  ->onDelete('cascade');
            $table->string('nama');                    // Nama peserta
            $table->string('nis')->nullable();         // Nomor Induk Siswa
            $table->string('nisn')->nullable();        // NISN
            $table->string('kelas')->nullable();       // Kelas
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peserta');
    }
};
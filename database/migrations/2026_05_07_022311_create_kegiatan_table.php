<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();                              // Primary key auto increment
            $table->string('nama_kegiatan');           // Nama kegiatan
            $table->date('tanggal');                   // Tanggal kegiatan
            $table->text('deskripsi')->nullable();     // Deskripsi (boleh kosong)
            $table->string('penyelenggara');           // Nama penyelenggara
            $table->foreignId('user_id')               // Siapa yang buat
                  ->constrained()
                  ->onDelete('cascade');
            $table->timestamps();                      // created_at & updated_at otomatis
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};
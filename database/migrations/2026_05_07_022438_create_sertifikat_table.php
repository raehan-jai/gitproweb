<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sertifikat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peserta_id')
                  ->constrained('peserta')
                  ->onDelete('cascade');
            $table->foreignId('kegiatan_id')
                  ->constrained('kegiatan')
                  ->onDelete('cascade');
            $table->foreignId('template_id')
                  ->nullable()
                  ->constrained('template_sertifikat')
                  ->onDelete('set null');
            $table->string('nomor_sertifikat')->unique(); // Nomor unik otomatis
            $table->string('file_path')->nullable();      // Path file PDF
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sertifikat');
    }
};
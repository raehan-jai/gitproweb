<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('template_sertifikat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_template');
            $table->string('background_path')->nullable();  // Path file gambar background
            // Posisi teks (dalam persen atau pixel)
            $table->integer('pos_nama_x')->default(50);
            $table->integer('pos_nama_y')->default(50);
            $table->integer('pos_kegiatan_x')->default(50);
            $table->integer('pos_kegiatan_y')->default(60);
            $table->integer('pos_tanggal_x')->default(50);
            $table->integer('pos_tanggal_y')->default(70);
            $table->integer('pos_nomor_x')->default(50);
            $table->integer('pos_nomor_y')->default(80);
            $table->integer('font_size_nama')->default(24);
            $table->integer('font_size_detail')->default(14);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('template_sertifikat');
    }
};
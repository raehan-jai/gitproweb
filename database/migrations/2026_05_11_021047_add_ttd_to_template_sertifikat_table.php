<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('template_sertifikat', function (Blueprint $table) {
            $table->string('ttd_kepsek_path')->nullable()->after('background_path');
            $table->string('nama_kepsek')->nullable()->after('ttd_kepsek_path');
            $table->string('nip_kepsek')->nullable()->after('nama_kepsek');
            $table->string('ttd_panitia_path')->nullable()->after('nip_kepsek');
            $table->string('nama_panitia')->nullable()->after('ttd_panitia_path');
            $table->string('nip_panitia')->nullable()->after('nama_panitia');
        });
    }

    public function down(): void
    {
        Schema::table('template_sertifikat', function (Blueprint $table) {
            $table->dropColumn([
                'ttd_kepsek_path', 'nama_kepsek', 'nip_kepsek',
                'ttd_panitia_path', 'nama_panitia', 'nip_panitia',
            ]);
        });
    }
};
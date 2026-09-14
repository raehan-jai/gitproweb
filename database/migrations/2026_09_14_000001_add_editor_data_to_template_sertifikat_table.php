<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('template_sertifikat', function (Blueprint $table) {
            $table->json('certificate_texts')->nullable()->after('perataan_teks');
            $table->json('element_positions')->nullable()->after('certificate_texts');
        });
    }

    public function down(): void
    {
        Schema::table('template_sertifikat', function (Blueprint $table) {
            $table->dropColumn(['certificate_texts', 'element_positions']);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('template_sertifikat', function (Blueprint $table) {
            $table->json('element_styles')->nullable()->after('element_positions');
        });
    }

    public function down(): void
    {
        Schema::table('template_sertifikat', function (Blueprint $table) {
            $table->dropColumn('element_styles');
        });
    }
};

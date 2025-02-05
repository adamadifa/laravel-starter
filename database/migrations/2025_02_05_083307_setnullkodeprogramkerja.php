<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('realisasi_kegiatan', function (Blueprint $table) {
            $table->char('kode_program_kerja', 11)->nullable()->change();
            $table->char('kode_jobdesk', 10)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('realisasi_kegiatan', function (Blueprint $table) {
            //
        });
    }
};

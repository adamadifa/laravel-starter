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
        Schema::table('pendaftaran_dokumen', function (Blueprint $table) {
            $table->foreign('no_pendaftaran')->references('no_pendaftaran')->on('pendaftaran')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('kode_dokumen')->references('kode_dokumen')->on('pendaftaran_jenis_dokumen')->restrictOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftaran_dokumen', function (Blueprint $table) {
            //
        });
    }
};

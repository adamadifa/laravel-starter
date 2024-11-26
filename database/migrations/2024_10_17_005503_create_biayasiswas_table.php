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
        Schema::create('siswa_biaya', function (Blueprint $table) {
            $table->char('no_pendaftaran', 11);
            $table->char('kode_biaya', 8);
            $table->foreign('no_pendaftaran')->references('no_pendaftaran')->on('pendaftaran')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('kode_biaya')->references('kode_biaya')->on('konfigurasi_biaya')->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa_biaya');
    }
};

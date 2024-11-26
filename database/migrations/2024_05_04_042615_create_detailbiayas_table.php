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
        Schema::create('konfigurasi_biaya_detail', function (Blueprint $table) {
            $table->char('kode_biaya', 8);
            $table->char('kode_jenis_biaya', 3);
            $table->integer('jumlah');
            $table->foreign('kode_biaya')->references('kode_biaya')->on('konfigurasi_biaya')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('kode_jenis_biaya')->references('kode_jenis_biaya')->on('jenis_biaya')->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konfigurasi_biaya_detail');
    }
};

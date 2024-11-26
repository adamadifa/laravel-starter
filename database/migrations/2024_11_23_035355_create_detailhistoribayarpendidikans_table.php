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
        Schema::create('pendidikan_historibayar_detail', function (Blueprint $table) {
            $table->char('no_bukti', 10);
            $table->char('kode_biaya', 8);
            $table->char('kode_jenis_biaya', 3);
            $table->integer('jumlah');
            $table->string('keterangan');
            $table->foreign('no_bukti')->references('no_bukti')->on('pendidikan_historibayar')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('kode_biaya')->references('kode_biaya')->on('konfigurasi_biaya')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('kode_jenis_biaya')->references('kode_jenis_biaya')->on('jenis_biaya')->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailhistoribayarpendidikans');
    }
};

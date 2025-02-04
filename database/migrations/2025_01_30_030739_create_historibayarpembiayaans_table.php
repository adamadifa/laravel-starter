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
        Schema::create('koperasi_pembiayaan_historibayar', function (Blueprint $table) {
            $table->char('no_transaksi', 11)->primary();
            $table->date('tanggal');
            $table->char('no_akad', 10);
            $table->string('cicilan_ke');
            $table->integer('jumlah');
            $table->integer('id_petugas');
            $table->timestamps();
            $table->foreign('no_akad')->references('no_akad')->on('koperasi_pembiayaan')->restrictOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('koperasi_pembiayaan_historibayar');
    }
};

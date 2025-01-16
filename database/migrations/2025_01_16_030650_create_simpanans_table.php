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
        Schema::create('koperasi_simpanan', function (Blueprint $table) {
            $table->char('no_transaksi', 11)->primary();
            $table->date('tanggal');
            $table->char('no_anggota', 10);
            $table->char('kode_simpanan', 3);
            $table->integer('jumlah')->length(11);
            $table->char('jenis_transaksi', 1);
            $table->integer('saldo')->length(11);
            $table->string('berita', 255);
            $table->smallInteger('id_petugas')->length(6);
            $table->foreign('no_anggota')->references('no_anggota')->on('koperasi_anggota')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('kode_simpanan')->references('kode_simpanan')->on('koperasi_jenis_simpanan')->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simpanans');
    }
};

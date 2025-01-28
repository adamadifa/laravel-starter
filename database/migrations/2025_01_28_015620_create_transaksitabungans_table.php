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
        Schema::create('koperasi_tabungan_transaksi', function (Blueprint $table) {
            $table->char('no_transaksi', 11)->primary();
            $table->char('no_rekening', 14);
            $table->date('tanggal');
            $table->string('jenis_transaksi', 1);
            $table->integer('jumlah');
            $table->integer('saldo');
            $table->string('berita');
            $table->bigInteger('id_petugas')->unsigned();
            $table->foreign('no_rekening')->references('no_rekening')->on('koperasi_tabungan')->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('koperasi_tabungan_transaksi');
    }
};

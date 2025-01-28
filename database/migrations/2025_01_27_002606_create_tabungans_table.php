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
        Schema::create('koperasi_tabungan', function (Blueprint $table) {
            $table->string('no_rekening', 14)->primary();
            $table->string('no_anggota', 10);
            $table->string('kode_tabungan', 3);
            $table->integer('id_petugas');
            $table->integer('saldo');
            $table->timestamps();
            $table->foreign('no_anggota')->references('no_anggota')->on('koperasi_anggota')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('kode_tabungan')->references('kode_tabungan')->on('koperasi_jenis_tabungan')->restrictOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('koperasi_tabungan');
    }
};

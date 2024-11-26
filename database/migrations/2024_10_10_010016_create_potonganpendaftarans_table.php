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
        Schema::create('pendaftaran_potongan', function (Blueprint $table) {
            $table->char('kode_potongan', 10)->primary();
            $table->char('kode_pendaftaran', 11);
            $table->char('kode_jenis_biaya', 3);
            $table->string('keterangan');
            $table->integer('jumlah');
            $table->timestamps();
            $table->foreign('kode_pendaftaran')->references('no_pendaftaran')->on('pendaftaran')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('kode_jenis_biaya')->references('kode_jenis_biaya')->on('jenis_biaya')->restrictOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_potongan');
    }
};

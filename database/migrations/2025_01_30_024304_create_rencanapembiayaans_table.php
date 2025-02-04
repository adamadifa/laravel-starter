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
        Schema::create('koperasi_pembiayaan_rencana', function (Blueprint $table) {
            $table->string('no_akad', 10);
            $table->smallInteger('cicilan_ke');
            $table->smallInteger('bulan');
            $table->string('tahun');
            $table->integer('jumlah');
            $table->integer('bayar');
            $table->foreign('no_akad')->references('no_akad')->on('koperasi_pembiayaan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('koperasi_pembiayaan_rencana');
    }
};

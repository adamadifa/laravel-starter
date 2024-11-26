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
        Schema::create('konfigurasi_biaya', function (Blueprint $table) {
            $table->char('kode_biaya', 8)->primary();
            $table->char('kode_unit', 3);
            $table->smallInteger('tingkat');
            $table->char('kode_ta', 6);
            $table->timestamps();
            $table->foreign('kode_unit')->references('kode_unit')->on('unit')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('kode_ta')->references('kode_ta')->on('konfigurasi_tahun_ajaran')->restrictOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konfigurasi_biaya');
    }
};

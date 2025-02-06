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
        Schema::create('karyawan_anggota', function (Blueprint $table) {
            $table->char('npp', 10);
            $table->char('no_anggota', 10);
            $table->foreign('npp')->references('npp')->on('karyawan')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('no_anggota')->references('no_anggota')->on('koperasi_anggota')->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawananggotas');
    }
};

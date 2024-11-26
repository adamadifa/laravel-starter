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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->char('no_pendaftaran', 10)->primary();
            $table->date('tanggal_pendaftaran');
            $table->char('id_siswa', 7);
            $table->char('nis', 11)->nullable();
            $table->char('kode_asal_sekolah', 5)->nullable();
            $table->char('kode_penghasilan_ortu', 4)->nullable();
            $table->char('kode_unit', 3);
            $table->char('kode_ta', 6);
            $table->integer('id_user');
            $table->foreign('id_siswa')->references('id_siswa')->on('siswa')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('kode_unit')->references('kode_unit')->on('unit')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('kode_ta')->references('kode_ta')->on('konfigurasi_tahun_ajaran')->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};

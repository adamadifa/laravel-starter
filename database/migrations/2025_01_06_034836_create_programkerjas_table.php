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
        Schema::create('program_kerja', function (Blueprint $table) {
            $table->char('kode_program_kerja', 11); //2425PDD0001
            $table->date('tanggal_pelaksanaan');
            $table->char('kode_dept', 3);
            $table->char('kode_jabatan', 3);
            $table->text('program_kerja');
            $table->text('target_pencapaian');
            $table->text('keterangan');
            $table->bigInteger('id_user')->unsigned();
            $table->char('kode_ta', 6);
            $table->foreign('id_user')->references('id')->on('users')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('kode_dept')->references('kode_dept')->on('departemen')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('kode_jabatan')->references('kode_jabatan')->on('jabatan')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('kode_ta')->references('kode_ta')->on('konfigurasi_tahun_ajaran')->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_kerja');
    }
};

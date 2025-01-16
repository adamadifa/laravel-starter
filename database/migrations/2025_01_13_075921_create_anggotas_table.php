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
        Schema::create('koperasi_anggota', function (Blueprint $table) {
            $table->char('no_anggota', 10)->primary();
            $table->char('nik', 16);
            $table->string('nama_lengkap', 100);
            $table->string('tempat_lahir', 30);
            $table->date('tanggal_lahir');
            $table->char('jenis_kelamin', 1);
            $table->char('pendidikan_terakhir', 3);
            $table->char('status_pernikahan', 2);
            $table->smallInteger('jml_tanggungan');
            $table->string('nama_pasangan', 100);
            $table->string('pekerjaan_pasangan', 100);
            $table->string('nama_ibu', 100);
            $table->string('nama_saudara', 100);
            $table->string('no_hp', 20);
            $table->string('alamat', 255);
            $table->char('id_propinsi', 2);
            $table->char('id_kota', 4);
            $table->char('id_kecamatan', 7);
            $table->char('id_kelurahan', 10);
            $table->char('kode_pos', 6);
            $table->char('status_tinggal', 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('koperasi_anggota');
    }
};

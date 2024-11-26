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
        Schema::create('siswa', function (Blueprint $table) {
            $table->char('id_siswa', 7)->primary();
            $table->char('nisn', 10);
            $table->string('nama_lengkap');
            $table->char('jenis_kelamin', 1);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->smallInteger('anak_ke');
            $table->smallInteger('jumlah_saudara');
            $table->string('alamat');
            $table->char('kode_pos', 5);
            $table->char('no_kk', 16);
            $table->char('nik_ayah', 16);
            $table->string('nama_ayah');
            $table->string('pendidikan_ayah');
            $table->string('pekerjaan_ayah');
            $table->char('nik_ibu', 16);
            $table->string('nama_ibu');
            $table->string('pendidikan_ibu');
            $table->string('pekerjaan_ibu');
            $table->string('no_hp_orang_tua', 15);
            $table->integer('pin');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};

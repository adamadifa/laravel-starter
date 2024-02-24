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
        Schema::create('karyawan', function (Blueprint $table) {
            $table->char('npp', 10)->primary();
            $table->string('nama_lengkap', 50);
            $table->char('jenis_kelamin', 1);
            $table->string('tempat_lahir', 30)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('golongan_darah', 2)->nullable();
            $table->string('no_ktp', 16)->nullable();
            $table->string('no_kk', 16)->nullable();
            $table->string('no_hp', 16)->nullable();
            $table->string('status_kawin', 2)->nullable();
            $table->string('alamat_ktp')->nullable();
            $table->string('alamat_tinggal')->nullable();
            $table->date('tmt')->nullable();
            $table->char('status_karyawan', 1)->nullable();
            $table->string('pendidikan_terakhir', 3);
            $table->char('kode_jabatan', 3);
            $table->char('kode_unit', 3);
            $table->string('nama_ayah', 30)->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('alamat_orangtua')->nullable();
            $table->string('nama_pasangan', 30)->nullable();
            $table->string('tempat_lahir_pasangan', 30)->nullable();
            $table->date('tanggal_lahir_pasangan')->nullable();
            $table->string('pekerjaan_pasangan', 30);
            $table->string('password');
            $table->integer('pin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};

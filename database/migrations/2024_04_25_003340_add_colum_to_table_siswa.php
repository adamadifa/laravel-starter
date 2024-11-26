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
        Schema::table('siswa', function (Blueprint $table) {
            $table->char('nisn', 10)->nullable()->change();
            $table->char('jenis_kelamin', 1)->nullable()->change();
            $table->string('tempat_lahir')->nullable()->change();
            $table->date('tanggal_lahir')->nullable()->change();
            $table->smallInteger('anak_ke')->nullable()->change();
            $table->smallInteger('jumlah_saudara')->nullable()->change();
            $table->string('alamat')->nullable()->change();
            $table->char('kode_pos', 5)->nullable()->change();
            $table->char('no_kk', 16)->nullable()->change();
            $table->char('nik_ayah', 16)->nullable()->change();
            $table->string('nama_ayah')->nullable()->change();
            $table->string('pendidikan_ayah')->nullable()->change();
            $table->string('pekerjaan_ayah')->nullable()->change();
            $table->char('nik_ibu', 16)->nullable()->change();
            $table->string('nama_ibu')->nullable()->change();
            $table->string('pendidikan_ibu')->nullable()->change();
            $table->string('pekerjaan_ibu')->nullable()->change();
            $table->string('no_hp_orang_tua', 15)->nullable()->change();
            $table->integer('pin')->nullable()->change();
            $table->string('password')->nullable()->change();
            $table->char('id_province', 2)->nullable()->after('alamat');
            $table->char('id_regency', 4)->nullable()->after('id_province');
            $table->char('id_district', 6)->nullable()->after('id_regency');
            $table->char('id_village', 8)->nullable()->after('id_district');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            //
        });
    }
};

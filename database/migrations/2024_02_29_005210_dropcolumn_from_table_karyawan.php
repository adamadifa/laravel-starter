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
        Schema::table('karyawan', function (Blueprint $table) {
            $table->dropColumn('nama_ayah');
            $table->dropColumn('nama_ibu');
            $table->dropColumn('alamat_orangtua');
            $table->dropColumn('nama_pasangan');
            $table->dropColumn('tempat_lahir_pasangan');
            $table->dropColumn('tanggal_lahir_pasangan');
            $table->dropColumn('pekerjaan_pasangan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('karyawan', function (Blueprint $table) {
            $table->string('nama_ayah', 30)->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('alamat_orangtua')->nullable();
            $table->string('nama_pasangan', 30)->nullable();
            $table->string('tempat_lahir_pasangan', 30)->nullable();
            $table->date('tanggal_lahir_pasangan')->nullable();
            $table->string('pekerjaan_pasangan', 30);
        });
    }
};

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
        Schema::create('konfigurasi_jam_kerja', function (Blueprint $table) {
            $table->char('kode_jam_kerja', 4)->primary();
            $table->string('nama_jam_kerja', 20);
            $table->time('jam_masuk');
            $table->time('jam_pulang');
            $table->integer('total_jam');
            $table->char('lintas_hari', 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konfigurasi_jam_kerja');
    }
};

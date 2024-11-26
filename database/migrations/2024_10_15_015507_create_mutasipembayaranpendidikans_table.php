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
        Schema::create('pembayaran_pendidikan_mutasi', function (Blueprint $table) {
            $table->char('kode_mutasi', 22)->primary();
            $table->char('no_pendaftaran', 11);
            $table->char('kode_biaya', 8);
            $table->char('kode_jenis_biaya', 3);
            $table->integer('jumlah');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_pendidikan_mutasi');
    }
};

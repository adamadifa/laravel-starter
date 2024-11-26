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
        Schema::create('pendidikan_historibayar', function (Blueprint $table) {
            $table->char('no_bukti', 10)->primary();
            $table->char('no_pendaftaran', 11);
            $table->date('tanggal');
            $table->string('keterangan');
            $table->bigInteger('id_user')->unsigned();
            $table->foreign('no_pendaftaran')->references('no_pendaftaran')->on('pendaftaran')->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendidikan_historibayar');
    }
};

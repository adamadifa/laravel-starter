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
        Schema::create('kegiatan_ibadah', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->bigInteger('id_kategori_ibadah')->unsigned();
            $table->foreign('id_kategori_ibadah')->references('id')->on('kategori_ibadah')->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan_ibadah');
    }
};

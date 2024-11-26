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
        Schema::create('spp_rencana_detail', function (Blueprint $table) {
            $table->char('kode_rencana_spp', 14);
            $table->smallInteger('bulan');
            $table->integer('jumlah');
            $table->foreign('kode_rencana_spp')->references('kode_rencana_spp')->on('spp_rencana')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spp_rencana_detail');
    }
};

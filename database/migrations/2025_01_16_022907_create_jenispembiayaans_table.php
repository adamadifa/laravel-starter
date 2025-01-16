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
        Schema::create('koperasi_jenis_pembiayaan', function (Blueprint $table) {
            $table->char('kode_pembiayaan', 3)->primary();
            $table->string('jenis_pembiayaan');
            $table->smallInteger('persentase');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('koperasi_jenis_pembiayaan');
    }
};

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
        Schema::create('ledger_kategori', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori');
            $table->char('jenis_kategori', 2); //PM = Pemasukan , PK = Pengeluaran
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategoriledgers');
    }
};

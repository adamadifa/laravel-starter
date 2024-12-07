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
        Schema::create('ledger_transaksi', function (Blueprint $table) {
            $table->char('no_bukti', 12)->primary();
            $table->date('tanggal');
            $table->char('kode_ledger', 5);
            $table->string('keterangan');
            $table->bigInteger('jumlah');
            $table->char('debet_kredit');
            $table->timestamps();
            $table->foreign('kode_ledger')->references('kode_ledger')->on('ledger')->restrictOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ledger_transaksi');
    }
};

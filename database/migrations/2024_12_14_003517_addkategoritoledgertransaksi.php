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
        Schema::table('ledger_transaksi', function (Blueprint $table) {
            $table->bigInteger('id_kategori')->unsigned()->after('debet_kredit');
            $table->foreign('id_kategori')->references('id')->on('ledger_kategori')->restrictOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ledger_transaksi', function (Blueprint $table) {
            //
        });
    }
};

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
        Schema::create('realisasi_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->char('kode_dept', 3);
            $table->char('kode_jabatan', 3);
            $table->char('kode_jobdesk', 10);
            $table->text('uraian_kegiatan');
            $table->smallInteger('persentase');
            $table->bigInteger('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('kode_dept')->references('kode_dept')->on('departemen')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('kode_jabatan')->references('kode_jabatan')->on('jabatan')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('kode_jobdesk')->references('kode_jobdesk')->on('jobdesk')->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realisasikegiatans');
    }
};

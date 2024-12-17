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
        Schema::create('jobdesk', function (Blueprint $table) {
            $table->char('kode_jobdesk', 10)->primary();
            $table->string('nama_jobdesk');
            $table->char('kode_dept', 3);
            $table->char('kode_jabatan', 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobdesks');
    }
};

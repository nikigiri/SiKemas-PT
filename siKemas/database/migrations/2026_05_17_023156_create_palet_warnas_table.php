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
        Schema::create('palet_warnas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_palet');
            $table->string('warna_utama');
            $table->string('warna_sekunder')->nullable();
            $table->string('warna_aksen')->nullable();
            $table->string('kode_hex')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('palet_warnas');
    }
};

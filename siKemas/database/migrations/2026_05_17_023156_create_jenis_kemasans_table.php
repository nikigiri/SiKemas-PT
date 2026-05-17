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
        Schema::create('jenis_kemasans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kemasan'); 
            $table->text('deskripsi_kemasan')->nullable();
            $table->string('ikon_kemasan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_kemasans');
    }
};

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
        Schema::create('kwts', function (Blueprint $table) {
                $table->id();
                $table->string('nama_kwt');
                $table->string('no_kwt')->nullable();
                $table->text('alamat_kwt')->nullable();
                $table->string('desa')->nullable();
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kwts');
    }
};

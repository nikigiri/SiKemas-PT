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
        Schema::create('elemens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desain_id')->constrained()->onDelete('cascade');
            $table->string('tipe_elemen');
            $table->text('teks')->nullable();
            $table->string('font')->nullable();
            $table->string('warna')->nullable();
            $table->float('sumbu_x')->default(0);
            $table->float('sumbu_y')->default(0);
            $table->float('rotasi')->default(0);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elemens');
    }
};

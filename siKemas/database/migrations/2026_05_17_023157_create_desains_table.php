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
        Schema::create('desains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained()->onDelete('cascade');
            $table->foreignId('jenis_kemasan_id')->constrained('jenis_kemasans')->onDelete('cascade');
            $table->foreignId('palet_warna_id')->constrained('palet_warnas')->onDelete('cascade');
            $table->string('judul_desain');
            $table->enum('status_desain', ['draft', 'generated', 'exported'])->default('draft');
            $table->string('preview_file')->nullable();
            $table->text('teks_ai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desains');
    }
};

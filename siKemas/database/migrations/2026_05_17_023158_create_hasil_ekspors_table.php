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
        Schema::create('hasil_ekspors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desain_id')->constrained()->onDelete('cascade');
            $table->string('format_file');
            $table->string('resolusi')->nullable();
            $table->string('file_path');
            $table->timestamp('tgl_ekspor')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_ekspors');
    }
};

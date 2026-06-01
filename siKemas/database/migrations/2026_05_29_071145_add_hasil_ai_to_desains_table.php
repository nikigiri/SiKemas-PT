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
        Schema::table('desains', function (Blueprint $table) {
            // Menambahkan kolom hasil_ai setelah kolom status_desain
            $table->longText('hasil_ai')->nullable()->after('status_desain');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('desains', function (Blueprint $table) {
            // Menghapus kolom jika di-rollback
            $table->dropColumn('hasil_ai');
        });
    }
};
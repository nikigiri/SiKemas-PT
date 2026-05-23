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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('kwt_id')->nullable()->constrained('kwts')->onDelete('set null')->after('alamat_usaha');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('kwt_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['kwt_id']);
            $table->dropColumn(['kwt_id', 'status']);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('desains', function (Blueprint $table) {
            $table->text('mockup_url')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('desains', function (Blueprint $table) {
            $table->dropColumn('mockup_url');
        });
    }
};
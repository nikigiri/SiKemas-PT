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
        Schema::table('jenis_kemasans', function (Blueprint $table) {
            $table->foreignId('kwt_id')->nullable()->constrained('kwts')->nullOnDelete()->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('jenis_kemasans', function (Blueprint $table) {
            $table->dropForeign(['kwt_id']);
            $table->dropColumn('kwt_id');
        });
    }
};

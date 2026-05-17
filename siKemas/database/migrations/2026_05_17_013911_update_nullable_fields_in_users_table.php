<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nama_usaha')->nullable()->change();
            $table->string('no_tlp')->nullable()->change();
            $table->text('alamat_usaha')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nama_usaha')->nullable(false)->change();
            $table->string('no_tlp')->nullable(false)->change();
            $table->text('alamat_usaha')->nullable(false)->change();
        });
    }
};
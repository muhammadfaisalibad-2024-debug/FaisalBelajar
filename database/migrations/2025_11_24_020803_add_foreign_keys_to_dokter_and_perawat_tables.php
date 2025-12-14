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
        Schema::table('dokter', function (Blueprint $table) {
            $table->foreign('id_user')->references('iduser')->on('user')->onDelete('cascade');
        });

        Schema::table('perawat', function (Blueprint $table) {
            $table->foreign('id_user')->references('iduser')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dokter', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
        });

        Schema::table('perawat', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
        });
    }
};

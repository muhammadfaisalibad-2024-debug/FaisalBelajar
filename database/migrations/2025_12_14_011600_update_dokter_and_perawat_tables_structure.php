<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop foreign keys first
        Schema::table('dokter', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
        });
        
        Schema::table('perawat', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
        });

        // Drop existing tables
        Schema::dropIfExists('dokter');
        Schema::dropIfExists('perawat');

        // Recreate dokter table with exact structure
        Schema::create('dokter', function (Blueprint $table) {
            $table->integer('id_dokter')->autoIncrement();
            $table->string('alamat', 100);
            $table->string('no_hp', 45);
            $table->string('bidang_dokter', 100);
            $table->char('jenis_kelamin', 1);
            $table->bigInteger('id_user');
            
            $table->foreign('id_user')->references('iduser')->on('user')->onDelete('cascade');
        });

        // Recreate perawat table with exact structure
        Schema::create('perawat', function (Blueprint $table) {
            $table->integer('id_perawat')->autoIncrement();
            $table->string('alamat', 100);
            $table->string('no_hp', 45);
            $table->char('jenis_kelamin', 1);
            $table->string('pendidikan', 100);
            $table->bigInteger('id_user');
            
            $table->foreign('id_user')->references('iduser')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokter');
        Schema::dropIfExists('perawat');
    }
};

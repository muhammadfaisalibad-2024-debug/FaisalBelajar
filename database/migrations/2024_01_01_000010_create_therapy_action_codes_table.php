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
        Schema::create('kode_tindakan_terapi', function (Blueprint $table) {
            $table->integer('idkode_tindakan_terapi')->autoIncrement();
            $table->string('kode', 5)->nullable();
            $table->string('deskripsi_tindakan_terapi', 100)->nullable();
            $table->integer('idkategori')->nullable();
            $table->integer('idkategori_klinis')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kode_tindakan_terapi');
    }
};

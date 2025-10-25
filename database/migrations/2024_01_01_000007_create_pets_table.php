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
        Schema::create('pet', function (Blueprint $table) {
            $table->integer('idpet')->autoIncrement();
            $table->string('nama', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('warna_tanda', 45)->nullable();
            $table->char('jenis_kelamin', 1)->nullable();
            $table->integer('idpemilik')->nullable();
            $table->integer('idras_hewan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet');
    }
};

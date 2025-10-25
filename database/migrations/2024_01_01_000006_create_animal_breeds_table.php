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
        Schema::create('ras_hewan', function (Blueprint $table) {
            $table->integer('idras_hewan')->autoIncrement();
            $table->string('nama_ras', 100)->nullable();
            $table->integer('idjenis_hewan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ras_hewan');
    }
};

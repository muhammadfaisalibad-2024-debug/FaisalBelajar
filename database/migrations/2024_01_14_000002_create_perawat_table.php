<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perawat', function (Blueprint $table) {
            $table->integer('id_perawat')->autoIncrement();
            $table->string('alamat', 100)->nullable();
            $table->string('no_hp', 45)->nullable();
            $table->char('jenis_kelamin', 1)->nullable();
            $table->string('pendidikan', 100)->nullable();
            $table->bigInteger('id_user');
            
            $table->index('id_user');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perawat');
    }
};

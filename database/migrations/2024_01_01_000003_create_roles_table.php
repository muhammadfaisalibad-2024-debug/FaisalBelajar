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
        Schema::create('role', function (Blueprint $table) {
            $table->integer('idrole')->autoIncrement();
            $table->string('nama_role', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Pivot table for user-role relationship
        Schema::create('role_user', function (Blueprint $table) {
            $table->integer('idrole_user')->autoIncrement();
            $table->bigInteger('iduser');
            $table->integer('idrole');
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('role');
    }
};

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
        Schema::create('temu_dokter', function (Blueprint $table) {
            $table->integer('idreservasi_dokter', true); // Auto increment primary key
            $table->integer('no_urut')->nullable();
            $table->timestamp('waktu_daftar')->nullable();
            $table->char('status', 1)->nullable();
            $table->integer('idpet')->nullable();
            $table->integer('idrole_user')->nullable();
            
            // Foreign keys
            $table->foreign('idpet', 'temu_dokter_ibfk_1')
                  ->references('idpet')->on('pet')
                  ->onDelete('restrict')->onUpdate('restrict');
            
            $table->foreign('idrole_user', 'temu_dokter_ibfk_2')
                  ->references('idrole_user')->on('role_user')
                  ->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temu_dokter');
    }
};

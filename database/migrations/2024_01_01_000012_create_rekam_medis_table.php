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
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->integer('idrekam_medis', true); // Auto increment primary key
            $table->timestamp('created_at')->nullable();
            $table->string('anamnesa', 1000)->nullable();
            $table->string('temuan_klinis', 1000)->nullable();
            $table->string('diagnosa', 1000)->nullable();
            $table->bigInteger('dokter_pemeriksa');
            $table->integer('idreservasi_dokter');
            
            // Foreign keys
            $table->foreign('dokter_pemeriksa', 'rekam_medis_ibfk_1')
                  ->references('iduser')->on('user')
                  ->onDelete('restrict')->onUpdate('restrict');
            
            $table->foreign('idreservasi_dokter', 'rekam_medis_ibfk_2')
                  ->references('idreservasi_dokter')->on('temu_dokter')
                  ->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekam_medis');
    }
};

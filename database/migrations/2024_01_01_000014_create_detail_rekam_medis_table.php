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
        Schema::create('detail_rekam_medis', function (Blueprint $table) {
            $table->integer('iddetail_rekam_medis', true); // Auto increment primary key
            $table->integer('idrekam_medis')->nullable();
            $table->integer('idkode_tindakan_terapi')->nullable();
            $table->string('detail', 1000)->nullable();
            
            // Foreign keys
            $table->foreign('idrekam_medis', 'detail_rekam_medis_ibfk_1')
                  ->references('idrekam_medis')->on('rekam_medis')
                  ->onDelete('restrict')->onUpdate('restrict');
            
            $table->foreign('idkode_tindakan_terapi', 'detail_rekam_medis_ibfk_2')
                  ->references('idkode_tindakan_terapi')->on('kode_tindakan_terapi')
                  ->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_rekam_medis');
    }
};

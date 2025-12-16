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
        // Add soft delete columns to kategori_klinis table
        Schema::table('kategori_klinis', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->after('nama_kategori_klinis');
            $table->bigInteger('deleted_by')->nullable()->after('deleted_at');
        });

        // Add soft delete columns to kode_tindakan_terapi table
        Schema::table('kode_tindakan_terapi', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->after('idkategori_klinis');
            $table->bigInteger('deleted_by')->nullable()->after('deleted_at');
        });

        // Add soft delete columns to temu_dokter table
        Schema::table('temu_dokter', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->after('idrole_user');
            $table->bigInteger('deleted_by')->nullable()->after('deleted_at');
        });

        // Add soft delete columns to rekam_medis table
        Schema::table('rekam_medis', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->after('idreservasi_dokter');
            $table->bigInteger('deleted_by')->nullable()->after('deleted_at');
        });

        // Add soft delete columns to detail_rekam_medis table
        Schema::table('detail_rekam_medis', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->after('detail');
            $table->bigInteger('deleted_by')->nullable()->after('deleted_at');
        });

        // Add soft delete columns to role table
        Schema::table('role', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->after('nama_role');
            $table->bigInteger('deleted_by')->nullable()->after('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kategori_klinis', function (Blueprint $table) {
            $table->dropColumn(['deleted_at', 'deleted_by']);
        });

        Schema::table('kode_tindakan_terapi', function (Blueprint $table) {
            $table->dropColumn(['deleted_at', 'deleted_by']);
        });

        Schema::table('temu_dokter', function (Blueprint $table) {
            $table->dropColumn(['deleted_at', 'deleted_by']);
        });

        Schema::table('rekam_medis', function (Blueprint $table) {
            $table->dropColumn(['deleted_at', 'deleted_by']);
        });

        Schema::table('detail_rekam_medis', function (Blueprint $table) {
            $table->dropColumn(['deleted_at', 'deleted_by']);
        });

        Schema::table('role', function (Blueprint $table) {
            $table->dropColumn(['deleted_at', 'deleted_by']);
        });
    }
};

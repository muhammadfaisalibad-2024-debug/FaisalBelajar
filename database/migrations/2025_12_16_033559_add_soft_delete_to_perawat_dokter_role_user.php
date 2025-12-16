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
        // Add soft delete columns to perawat table
        Schema::table('perawat', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->after('iduser');
            $table->bigInteger('deleted_by')->nullable()->after('deleted_at');
        });

        // Add soft delete columns to dokter table
        Schema::table('dokter', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->after('iduser');
            $table->bigInteger('deleted_by')->nullable()->after('deleted_at');
        });

        // Add soft delete columns to role_user table
        Schema::table('role_user', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->after('status');
            $table->bigInteger('deleted_by')->nullable()->after('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perawat', function (Blueprint $table) {
            $table->dropColumn(['deleted_at', 'deleted_by']);
        });

        Schema::table('dokter', function (Blueprint $table) {
            $table->dropColumn(['deleted_at', 'deleted_by']);
        });

        Schema::table('role_user', function (Blueprint $table) {
            $table->dropColumn(['deleted_at', 'deleted_by']);
        });
    }
};

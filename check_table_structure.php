<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$tables = [
    'user',
    'pemilik',
    'pet',
    'jenis_hewan',
    'ras_hewan',
    'kategori',
    'kategori_klinis',
    'kode_tindakan_terapi',
    'temu_dokter',
    'rekam_medis',
    'detail_rekam_medis',
    'role',
    'perawat',
    'dokter',
    'role_user'
];

foreach ($tables as $table) {
    echo "\n=== Table: $table ===\n";
    try {
        $columns = DB::select("SHOW COLUMNS FROM `$table`");
        foreach ($columns as $column) {
            echo "- {$column->Field} ({$column->Type})\n";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "\n";
    }
}

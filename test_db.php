<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "DB Connection: " . config('database.default') . "\n";
echo "DB Name: " . config('database.connections.mysql.database') . "\n";
echo "DB Host: " . config('database.connections.mysql.host') . "\n";
echo "DB User: " . config('database.connections.mysql.username') . "\n";

// Test connection
try {
    $pdo = DB::connection()->getPdo();
    echo "\n✅ Database connection successful!\n";
    echo "Connected to: " . DB::connection()->getDatabaseName() . "\n";
} catch (\Exception $e) {
    echo "\n❌ Database connection failed!\n";
    echo "Error: " . $e->getMessage() . "\n";
}

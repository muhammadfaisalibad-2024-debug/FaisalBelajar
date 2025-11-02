<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Checking Dokter Data ===\n\n";

// Check role_user table for dokter
$dokters = \App\Models\RoleUser::where('idrole', 9)->get();
echo "Total RoleUser dengan idrole=9: " . $dokters->count() . "\n\n";

foreach ($dokters as $dokter) {
    echo "ID: {$dokter->idrole_user}\n";
    echo "IDUser: {$dokter->iduser}\n";
    echo "IDRole: {$dokter->idrole}\n";
    echo "Status: {$dokter->status}\n";
    
    // Try to get user
    $user = \App\Models\User::find($dokter->iduser);
    if ($user) {
        echo "User Nama: {$user->nama}\n";
        echo "User Email: {$user->email}\n";
    } else {
        echo "User: NOT FOUND\n";
    }
    echo "---\n";
}

// Check with eager loading
echo "\n=== With Eager Loading ===\n";
$doktersWithUser = \App\Models\RoleUser::with('user')
    ->where('idrole', 9)
    ->where('status', 1)
    ->get();
    
echo "Total Dokter (status=1): " . $doktersWithUser->count() . "\n\n";

foreach ($doktersWithUser as $dokter) {
    echo "ID: {$dokter->idrole_user}\n";
    if ($dokter->user) {
        echo "Nama: {$dokter->user->nama}\n";
        echo "Email: {$dokter->user->email}\n";
    } else {
        echo "User relation: NULL\n";
    }
    echo "---\n";
}

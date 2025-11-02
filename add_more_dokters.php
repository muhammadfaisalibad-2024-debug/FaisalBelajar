<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Adding More Dokter Users ===\n\n";

// Data dokter baru
$dokters = [
    [
        'nama' => 'Dr. Andi Setiawan',
        'email' => 'andi.dokter@mail.com',
        'password' => bcrypt('password'),
    ],
    [
        'nama' => 'Dr. Budi Santoso',
        'email' => 'budi.dokter@mail.com',
        'password' => bcrypt('password'),
    ],
    [
        'nama' => 'Dr. Citra Dewi',
        'email' => 'citra.dokter@mail.com',
        'password' => bcrypt('password'),
    ],
];

foreach ($dokters as $dokterData) {
    // Create user
    $user = \App\Models\User::create([
        'nama' => $dokterData['nama'],
        'email' => $dokterData['email'],
        'password' => $dokterData['password'],
    ]);
    
    echo "Created User: {$user->nama} (ID: {$user->iduser})\n";
    
    // Create role_user entry for dokter (idrole = 9)
    $roleUser = \App\Models\RoleUser::create([
        'iduser' => $user->iduser,
        'idrole' => 9, // Dokter
        'status' => 1,
    ]);
    
    echo "Created RoleUser: ID {$roleUser->idrole_user} - Status: {$roleUser->status}\n";
    echo "---\n";
}

echo "\n=== Total Dokter Now ===\n";
$totalDokter = \App\Models\RoleUser::where('idrole', 9)->where('status', 1)->count();
echo "Total Dokter (status=1): {$totalDokter}\n";

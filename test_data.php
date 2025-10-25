<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== DATABASE CONNECTION TEST ===\n\n";

// Test User
echo "📊 USERS (" . \App\Models\User::count() . " records)\n";
$users = \App\Models\User::take(3)->get(['iduser', 'nama', 'email']);
foreach($users as $user) {
    echo "  - {$user->nama} ({$user->email})\n";
}

echo "\n📋 ROLES (" . \App\Models\Role::count() . " records)\n";
$roles = \App\Models\Role::take(5)->get();
foreach($roles as $role) {
    echo "  - {$role->nama_role}\n";
}

echo "\n👤 PEMILIK (" . \App\Models\Owner::count() . " records)\n";
$owners = \App\Models\Owner::with('user')->take(3)->get();
foreach($owners as $owner) {
    $userName = $owner->user->nama ?? 'N/A';
    echo "  - {$userName} | WA: {$owner->no_wa}\n";
}

echo "\n🐾 PETS (" . \App\Models\Pet::count() . " records)\n";
$pets = \App\Models\Pet::with('owner.user', 'animalBreed')->take(3)->get();
foreach($pets as $pet) {
    $ownerName = $pet->owner->user->nama ?? 'N/A';
    $breed = $pet->animalBreed->nama_ras ?? 'N/A';
    echo "  - {$pet->nama} ({$breed}) - Owner: {$ownerName}\n";
}

echo "\n🏥 JENIS HEWAN (" . \App\Models\AnimalType::count() . " records)\n";
$types = \App\Models\AnimalType::withCount('breeds')->get();
foreach($types as $type) {
    echo "  - {$type->nama_jenis_hewan} ({$type->breeds_count} ras)\n";
}

echo "\n✅ Semua data berhasil dibaca dari database!\n";

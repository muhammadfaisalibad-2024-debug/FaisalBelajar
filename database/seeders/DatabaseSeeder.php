<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\AnimalType;
use App\Models\AnimalBreed;
use App\Models\ClinicalCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Roles
        $adminRole = Role::create([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'description' => 'Full system access',
        ]);

        $dokterRole = Role::create([
            'name' => 'dokter',
            'display_name' => 'Dokter Hewan',
            'description' => 'Veterinary doctor access',
        ]);

        $staffRole = Role::create([
            'name' => 'staff',
            'display_name' => 'Staff',
            'description' => 'Staff access',
        ]);

        // Create Admin User
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@rshp.com',
            'password' => Hash::make('password'),
        ]);
        $admin->roles()->attach($adminRole);

        // Create Dokter User
        $dokter = User::create([
            'name' => 'Dr. John Doe',
            'email' => 'dokter@rshp.com',
            'password' => Hash::make('password'),
        ]);
        $dokter->roles()->attach($dokterRole);

        // Create Animal Types
        $anjing = AnimalType::create([
            'name' => 'Anjing',
            'description' => 'Hewan mamalia karnivora domestik',
        ]);

        $kucing = AnimalType::create([
            'name' => 'Kucing',
            'description' => 'Hewan mamalia karnivora domestik',
        ]);

        $burung = AnimalType::create([
            'name' => 'Burung',
            'description' => 'Hewan vertebrata bersayap',
        ]);

        // Create Animal Breeds
        AnimalBreed::create([
            'animal_type_id' => $anjing->id,
            'name' => 'Golden Retriever',
            'description' => 'Anjing ras besar yang ramah',
        ]);

        AnimalBreed::create([
            'animal_type_id' => $anjing->id,
            'name' => 'Bulldog',
            'description' => 'Anjing ras sedang yang kuat',
        ]);

        AnimalBreed::create([
            'animal_type_id' => $kucing->id,
            'name' => 'Persian',
            'description' => 'Kucing berbulu panjang',
        ]);

        AnimalBreed::create([
            'animal_type_id' => $kucing->id,
            'name' => 'Siamese',
            'description' => 'Kucing berbulu pendek',
        ]);

        // Create Clinical Categories
        $konsultasi = ClinicalCategory::create([
            'name' => 'Konsultasi',
            'code' => 'KONS',
            'description' => 'Layanan konsultasi medis',
        ]);

        $vaksinasi = ClinicalCategory::create([
            'name' => 'Vaksinasi',
            'code' => 'VAK',
            'description' => 'Layanan vaksinasi hewan',
        ]);

        $grooming = ClinicalCategory::create([
            'name' => 'Grooming',
            'code' => 'GROOM',
            'description' => 'Layanan perawatan hewan',
        ]);

        $operasi = ClinicalCategory::create([
            'name' => 'Operasi',
            'code' => 'OPS',
            'description' => 'Tindakan operasi medis',
        ]);
    }
}


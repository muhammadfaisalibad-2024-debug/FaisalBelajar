<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['idrole' => 1, 'nama_role' => 'Admin'],
            ['idrole' => 2, 'nama_role' => 'Dokter'],
            ['idrole' => 3, 'nama_role' => 'Perawat'],
            ['idrole' => 4, 'nama_role' => 'Resepsionis'],
        ];

        foreach ($roles as $role) {
            DB::table('role')->updateOrInsert(
                ['idrole' => $role['idrole']],
                $role
            );
        }

        $this->command->info('Roles seeded successfully!');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /// Daftar role yang akan ditambahkan
        $roles = [
            'admin',
            'editor',
            'user',
        ];

        // Menambahkan role ke database
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }
}

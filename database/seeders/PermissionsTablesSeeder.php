<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Permission as ModelsPermission;
use Spatie\Permission\Models\Role;

class PermissionsTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar permission yang akan ditambahkan
        $permissions = [
            'create articles',
            'edit articles',
            'delete articles',
            'view articles',
        ];

        // Menambahkan permission ke database
        foreach ($permissions as $permission) {
            ModelsPermission::create(['name' => $permission]);
        }

        // Menetapkan permissions ke roles
        $role = Role::findOrFail(1);


        $role->givePermissionTo($permissions);
    }
}

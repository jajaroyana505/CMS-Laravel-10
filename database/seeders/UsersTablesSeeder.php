<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role as ModelsRole;

class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat user dengan role tertentu
        $user = User::create([
            'name' => 'Amin',
            'email' => 'admin@email.com',
            'username' => "admin",
            'password' => bcrypt('admin123'),
        ]);

        // Ambil role yang sudah ada
        $role = ModelsRole::where('name', 'admin')->first();

        // Tambahkan role ke user
        if ($role) {
            $user->assignRole($role);
        }
    }
}

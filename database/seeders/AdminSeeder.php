<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Super Admin
        User::updateOrCreate(
            ['email' => 'superadmin@rsudtalisayan.go.id'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('admin123'),
                'role' => 'superadmin',
            ]
        );

        // Admin Pendaftaran
        User::updateOrCreate(
            ['email' => 'pendaftaran@rsudtalisayan.go.id'],
            [
                'name' => 'Admin Pendaftaran',
                'password' => Hash::make('admin123'),
                'role' => 'admin_pendaftaran'
            ]
        );
    }
}

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
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@rsudtalisayan.go.id',
            'password' => Hash::make('admin123'),
            'role' => 'superadmin',
        ]);

        // Admin Pendaftaran
        User::create([
            'name' => 'Admin Pendaftaran',
            'email' => 'pendaftaran@rsudtalisayan.go.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin_pendaftaran'
        ]);
    }
} 
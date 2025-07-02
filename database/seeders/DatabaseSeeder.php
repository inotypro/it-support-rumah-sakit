<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            AdminSeeder::class,
            RegistrationSeeder::class,
            TicketSeeder::class,
            SurveySeeder::class,
        ]);

        // Create Superadmin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@rsudtalisayan.com',
            'password' => Hash::make('superadmin123'),
            'role' => 'superadmin'
        ]);

        // Create Admin Pendaftaran
        User::create([
            'name' => 'Admin Pendaftaran',
            'email' => 'pendaftaran@rsudtalisayan.com',
            'password' => Hash::make('pendaftaran123'),
            'role' => 'pendaftaran'
        ]);
    }
}

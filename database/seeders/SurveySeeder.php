<?php

namespace Database\Seeders;

use App\Models\Survey;
use Illuminate\Database\Seeder;

class SurveySeeder extends Seeder
{
    public function run()
    {
        $surveys = [
            [
                'nama' => 'John Doe',
                'email' => 'john@example.com',
                'no_hp' => '081234567890',
                'pelayanan_medis_rating' => 5,
                'fasilitas_rating' => 4,
                'kebersihan_rating' => 5,
                'kecepatan_pelayanan_rating' => 4,
                'keramahan_staff_rating' => 5,
                'saran' => 'Pelayanan sangat baik dan ramah',
                'created_at' => '2024-03-19 09:55:18',
                'updated_at' => '2024-03-19 09:55:18'
            ],
            [
                'nama' => 'Jane Smith',
                'email' => 'jane@example.com',
                'no_hp' => '082345678901',
                'pelayanan_medis_rating' => 4,
                'fasilitas_rating' => 5,
                'kebersihan_rating' => 4,
                'kecepatan_pelayanan_rating' => 5,
                'keramahan_staff_rating' => 4,
                'saran' => 'Fasilitas lengkap dan modern',
                'created_at' => '2024-03-19 10:15:22',
                'updated_at' => '2024-03-19 10:15:22'
            ],
        ];

        foreach ($surveys as $survey) {
            Survey::create($survey);
        }
    }
} 
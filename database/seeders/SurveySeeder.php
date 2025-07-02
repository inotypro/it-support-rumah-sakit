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
                'name' => 'Budi Santoso',
                'phone_number' => '081234567890',
                'pelayanan_medis_rating' => 5,
                'fasilitas_rating' => 4,
                'kebersihan_rating' => 5,
                'kecepatan_pelayanan_rating' => 4,
                'keramahan_staff_rating' => 5,
                'saran' => 'Pelayanan sangat baik dan ramah'
            ],
            [
                'name' => 'Siti Aminah',
                'phone_number' => '082345678901',
                'pelayanan_medis_rating' => 4,
                'fasilitas_rating' => 5,
                'kebersihan_rating' => 4,
                'kecepatan_pelayanan_rating' => 5,
                'keramahan_staff_rating' => 4,
                'saran' => 'Fasilitas lengkap dan modern'
            ],
            [
                'name' => 'Andi Wijaya',
                'phone_number' => '083456789012',
                'pelayanan_medis_rating' => 5,
                'fasilitas_rating' => 5,
                'kebersihan_rating' => 5,
                'kecepatan_pelayanan_rating' => 5,
                'keramahan_staff_rating' => 5,
                'saran' => 'Sangat puas dengan pelayanan yang diberikan'
            ],
            [
                'name' => 'Dewi Lestari',
                'phone_number' => '084567890123',
                'pelayanan_medis_rating' => 3,
                'fasilitas_rating' => 4,
                'kebersihan_rating' => 4,
                'kecepatan_pelayanan_rating' => 3,
                'keramahan_staff_rating' => 4,
                'saran' => 'Perlu perbaikan pada kecepatan pelayanan'
            ]
        ];

        foreach ($surveys as $survey) {
            Survey::create($survey);
        }
    }
}

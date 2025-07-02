<?php

namespace Database\Seeders;

use App\Models\Registration;
use Illuminate\Database\Seeder;

class RegistrationSeeder extends Seeder
{
    public function run()
    {
        // Hapus semua data registrasi yang ada
        Registration::truncate();

        // Buat 5 data dummy baru
        $registrations = [
            [
                'medical_record_number' => 'RM-2024-001',
                'full_name' => 'Ahmad Saputra',
                'nik' => '3171234567890001',
                'gender' => 'Laki-laki',
                'birth_date' => '1990-05-15',
                'phone_number' => '081234567890',
                'religion' => 'Islam',
                'education' => 'S1',
                'marital_status' => 'Menikah',
                'spouse_parent_name' => 'Siti Aminah',
                'mother_name' => 'Fatimah',
                'address' => 'Jl. Mawar No. 123, Jakarta Selatan',
                'poly' => 'Poli Umum',
                'status' => 'proses',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'medical_record_number' => 'RM-2024-002',
                'full_name' => 'Siti Rahayu',
                'nik' => '3171234567890002',
                'gender' => 'Perempuan',
                'birth_date' => '1995-08-20',
                'phone_number' => '082345678901',
                'religion' => 'Islam',
                'education' => 'D3',
                'marital_status' => 'Belum Menikah',
                'spouse_parent_name' => 'Budi Santoso',
                'mother_name' => 'Sumiati',
                'address' => 'Jl. Melati No. 45, Jakarta Timur',
                'poly' => 'Poli Gigi',
                'status' => 'selesai',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'medical_record_number' => 'RM-2024-003',
                'full_name' => 'Budi Prakoso',
                'nik' => '3171234567890003',
                'gender' => 'Laki-laki',
                'birth_date' => '1988-12-10',
                'phone_number' => '083456789012',
                'religion' => 'Kristen',
                'education' => 'SMA/SMK',
                'marital_status' => 'Menikah',
                'spouse_parent_name' => 'Dewi Lestari',
                'mother_name' => 'Suryani',
                'address' => 'Jl. Anggrek No. 78, Jakarta Barat',
                'poly' => 'Poli Penyakit Dalam',
                'status' => 'batal',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'medical_record_number' => 'RM-2024-004',
                'full_name' => 'Dewi Anggraini',
                'nik' => '3171234567890004',
                'gender' => 'Perempuan',
                'birth_date' => '1992-03-25',
                'phone_number' => '084567890123',
                'religion' => 'Islam',
                'education' => 'S1',
                'marital_status' => 'Menikah',
                'spouse_parent_name' => 'Rudi Hermawan',
                'mother_name' => 'Kartini',
                'address' => 'Jl. Dahlia No. 56, Jakarta Utara',
                'poly' => 'Poli Kandungan',
                'status' => 'proses',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'medical_record_number' => 'RM-2024-005',
                'full_name' => 'Rudi Setiawan',
                'nik' => '3171234567890005',
                'gender' => 'Laki-laki',
                'birth_date' => '1985-07-30',
                'phone_number' => '085678901234',
                'religion' => 'Islam',
                'education' => 'S2',
                'marital_status' => 'Menikah',
                'spouse_parent_name' => 'Maya Sari',
                'mother_name' => 'Sumarni',
                'address' => 'Jl. Kenanga No. 90, Jakarta Pusat',
                'poly' => 'Poli Bedah',
                'status' => 'selesai',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        foreach ($registrations as $registration) {
            Registration::create($registration);
        }
    }
} 
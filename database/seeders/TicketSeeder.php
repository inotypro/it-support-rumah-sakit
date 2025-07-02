<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run()
    {
        Ticket::truncate();

        $tickets = [
            [
                'name' => 'Ahmad Rizki',
                'unit' => 'Farmasi',
                'phone' => '081234567890',
                'description' => 'Printer di ruang farmasi tidak bisa mencetak, muncul error paper jam',
                'status' => 'pending',
                'image_path' => null,
                'response' => null
            ],
            [
                'name' => 'Siti Aminah',
                'unit' => 'Laboratorium',
                'phone' => '081234567891',
                'description' => 'Komputer di lab tidak bisa login windows, muncul blue screen',
                'status' => 'progress',
                'image_path' => null,
                'response' => null
            ],
            [
                'name' => 'Dr. Budi Santoso',
                'unit' => 'Poli Umum',
                'phone' => '081234567892',
                'description' => 'Aplikasi SIMRS tidak bisa dibuka di komputer poli umum',
                'status' => 'completed',
                'image_path' => null,
                'response' => null
            ],
            [
                'name' => 'Ratna Sari',
                'unit' => 'Radiologi',
                'phone' => '081234567893',
                'description' => 'Monitor komputer radiologi tidak mau menyala sama sekali',
                'status' => 'progress',
                'image_path' => null,
                'response' => null
            ],
            [
                'name' => 'Dr. Eko Prasetyo',
                'unit' => 'IGD',
                'phone' => '081234567894',
                'description' => 'Koneksi internet di ruang IGD sangat lambat sejak tadi pagi',
                'status' => 'completed',
                'image_path' => null,
                'response' => null
            ]
        ];

        foreach ($tickets as $ticket) {
            Ticket::create($ticket);
        }
    }
}

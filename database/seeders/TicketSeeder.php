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
                'reporter_name' => 'Ahmad Rizki',
                'department' => 'Farmasi',
                'title' => 'Printer Tidak Berfungsi',
                'description' => 'Printer di ruang farmasi tidak bisa mencetak, muncul error paper jam',
                'status' => 'pending',
                'notes' => null
            ],
            [
                'reporter_name' => 'Siti Aminah',
                'department' => 'Laboratorium',
                'title' => 'Komputer Tidak Bisa Login',
                'description' => 'Komputer di lab tidak bisa login windows, muncul blue screen',
                'status' => 'in_progress',
                'notes' => 'Sedang dilakukan pengecekan hardware oleh teknisi'
            ],
            [
                'reporter_name' => 'Dr. Budi Santoso',
                'department' => 'Poli Umum',
                'title' => 'Aplikasi SIMRS Error',
                'description' => 'Aplikasi SIMRS tidak bisa dibuka di komputer poli umum',
                'status' => 'completed',
                'notes' => 'Sudah diperbaiki dengan mengupdate driver dan restart aplikasi'
            ],
            [
                'reporter_name' => 'Ratna Sari',
                'department' => 'Radiologi',
                'title' => 'Monitor Tidak Menyala',
                'description' => 'Monitor komputer radiologi tidak mau menyala sama sekali',
                'status' => 'in_progress',
                'notes' => 'Dalam proses penggantian monitor dengan yang baru'
            ],
            [
                'reporter_name' => 'Dr. Eko Prasetyo',
                'department' => 'IGD',
                'title' => 'Jaringan Internet Lambat',
                'description' => 'Koneksi internet di ruang IGD sangat lambat sejak tadi pagi',
                'status' => 'completed',
                'notes' => 'Router sudah dikonfigurasi ulang dan jaringan sudah normal'
            ]
        ];

        foreach ($tickets as $ticket) {
            Ticket::create($ticket);
        }
    }
} 
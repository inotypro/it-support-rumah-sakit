<?php

namespace App\Exports;

use App\Models\Survey;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SurveysExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Survey::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'No. HP',
            'Pelayanan Medis',
            'Fasilitas',
            'Kebersihan',
            'Kecepatan Pelayanan',
            'Keramahan Staff',
            'Saran',
            'Tanggal Dibuat',
            'Tanggal Diupdate'
        ];
    }

    public function map($survey): array
    {
        return [
            $survey->id,
            $survey->name,
            $survey->phone_number,
            $survey->pelayanan_medis_rating,
            $survey->fasilitas_rating,
            $survey->kebersihan_rating,
            $survey->kecepatan_pelayanan_rating,
            $survey->keramahan_staff_rating,
            $survey->saran,
            $survey->created_at->format('d/m/Y H:i:s'),
            $survey->updated_at->format('d/m/Y H:i:s')
        ];
    }
}

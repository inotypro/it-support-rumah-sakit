<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $averageRatings = [
            'pelayanan_medis' => Survey::avg('pelayanan_medis_rating') ?? 0,
            'fasilitas' => Survey::avg('fasilitas_rating') ?? 0,
            'kebersihan' => Survey::avg('kebersihan_rating') ?? 0,
            'kecepatan_pelayanan' => Survey::avg('kecepatan_pelayanan_rating') ?? 0,
            'keramahan_staff' => Survey::avg('keramahan_staff_rating') ?? 0
        ];

        return view('welcome', compact('averageRatings'));
    }
} 
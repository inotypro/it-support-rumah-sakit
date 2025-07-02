<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'pelayanan_medis_rating',
        'fasilitas_rating',
        'kebersihan_rating',
        'kecepatan_pelayanan_rating',
        'keramahan_staff_rating',
        'saran'
    ];

    protected $casts = [
        'pelayanan_medis_rating' => 'integer',
        'fasilitas_rating' => 'integer',
        'kebersihan_rating' => 'integer',
        'kecepatan_pelayanan_rating' => 'integer',
        'keramahan_staff_rating' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

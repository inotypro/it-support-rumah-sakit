<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $table = 'registrations';

    protected $fillable = [
        'medical_record_number',
        'full_name',
        'nik',
        'gender',
        'birth_date',
        'phone_number',
        'religion',
        'education',
        'marital_status',
        'spouse_parent_name',
        'mother_name',
        'address',
        'poly',
        'status',
        'patient_type',
    ];

    protected $attributes = [
        'status' => 'proses'
    ];

    public const STATUS_PROSES = 'proses';
    public const STATUS_SELESAI = 'selesai';
    public const STATUS_BATAL = 'batal';

    public const STATUSES = [
        self::STATUS_PROSES => 'Proses',
        self::STATUS_SELESAI => 'Selesai',
        self::STATUS_BATAL => 'Dibatalkan'
    ];

    protected $dates = [
        'birth_date',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'is_verified' => 'boolean'
    ];

    public function scopeNewPatients($query)
    {
        return $query->where('patient_type', 'baru');
    }

    public function scopeExistingPatients($query)
    {
        return $query->where('patient_type', 'lama');
    }

    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    public function scopeUnverified($query)
    {
        return $query->where('is_verified', false);
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'proses' => '<span class="badge bg-warning">Proses</span>',
            'selesai' => '<span class="badge bg-success">Selesai</span>',
            'batal' => '<span class="badge bg-danger">Batal</span>',
            default => '<span class="badge bg-secondary">Unknown</span>'
        };
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'proses' => 'Proses',
            'selesai' => 'Selesai',
            'batal' => 'Dibatalkan',
            default => 'Unknown'
        };
    }

    public function getPatientTypeLabel()
    {
        return match($this->patient_type) {
            'bpjs' => 'BPJS',
            'umum' => 'Umum',
            default => 'Unknown'
        };
    }

    public function getPatientTypeBadgeAttribute()
    {
        return match($this->patient_type) {
            'baru' => '<span class="badge bg-info">Pasien Baru</span>',
            'lama' => '<span class="badge bg-primary">Pasien Lama</span>',
            default => '<span class="badge bg-secondary">Unknown</span>'
        };
    }
}
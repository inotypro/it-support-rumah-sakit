<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_number',
        'name',
        'unit',
        'phone',
        'description',
        'image_path',
        'status',
        'response'
    ];

    protected $attributes = [
        'status' => 'pending'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($ticket) {
            // Get the last ticket number
            $lastTicket = DB::table('tickets')->orderBy('id', 'desc')->first();

            if ($lastTicket) {
                // Extract the number from TIK-XXX format
                $lastNumber = intval(substr($lastTicket->ticket_number, 4));
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            // Format the new ticket number
            $ticket->ticket_number = 'TIK-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        });
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => 'warning',
            'progress' => 'info',
            'completed' => 'success',
            default => 'secondary'
        };
    }
}
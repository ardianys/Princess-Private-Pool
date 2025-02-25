<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Swimmingpoolschedule extends Model
{
    use HasFactory;

    protected $table = 'Swimmingpoolschedules';

    protected $fillable = [
        'swimmingpool_id',
        'day',
        'start_time',
        'end_time',
        'max_people',
        'current_people',
        'status',
    ];

    // Relasi ke Swimmingpool
    public function swimmingpool()
    {
        return $this->belongsTo(Swimmingpool::class);
    }

    // Cek apakah jadwal sudah penuh
    public function isFull(): bool
    {
        return $this->current_people >= $this->max_people;
    }
}

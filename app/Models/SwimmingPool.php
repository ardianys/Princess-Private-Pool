<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Swimmingpool extends Model
{
    protected $fillable = [
        'user_id',
        'image',
        'name',
        'description',
        'location',
        'operational_days',
        'opening_time',
        'closing_time',
        'price_per_person',
    ];

    protected $casts = [
        'opening_hours' => 'array',
    ];
    
    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

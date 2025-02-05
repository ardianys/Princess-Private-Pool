<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Swimmingpool extends Model
{
    protected $fillable = [
        'image',
        'name',
        'description',
        'location',
        'price_per_person',
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

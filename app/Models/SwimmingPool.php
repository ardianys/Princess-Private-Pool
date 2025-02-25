<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Swimmingpoolschedule;


class Swimmingpool extends Model
{
    protected $fillable = [
        'user_id',
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

    public function schedules()
    {
        return $this->hasMany(Swimmingpoolschedule::class, 'swimmingpool_id');
    }


}

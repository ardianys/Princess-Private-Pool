<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'swimming_pool_id',
        'number_of_people',
        'booking_date',
        'booking_time',
        'total_cost',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function swimmingPool()
    {
        return $this->belongsTo(Swimmingpool::class);
    }
}

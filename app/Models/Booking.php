<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'swimmingpool_id',
        'allotment_id',
        'slug', 
        'total_person',
        'total_payments',
        'payment_method',
        'status',
        // 'expired_time_payments'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            if (empty($booking->slug)) {
                $booking->slug = Str::uuid()->toString(); 
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function swimmingpool()
    {
        return $this->belongsTo(Swimmingpool::class);
    }

    public function allotment()
    {
        return $this->belongsTo(Allotment::class);
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

}

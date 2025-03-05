<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'booking_id', 'slug', 'transaction_id', 
        'total_amount', 'admin_fee', 'payment_method', 
        'status', 'expired_time'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($payment) {
            $payment->slug = 'payment-' . Str::random(10);
            $payment->transaction_id = Str::uuid();
            $payment->expired_time = Carbon::now()->addHours(3);
        });
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

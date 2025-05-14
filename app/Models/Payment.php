<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'snap_token',
        'order_id',
        'transaction_status',
        'payment_type',
        'va_number',
        'amount',
        'expired_at',
    ];

    protected $casts = [
        'expired_at' => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Allotment extends Model
{
    use HasFactory;

    protected $fillable = [
        'swimmingpool_id',
        'slug',
        'date',
        'open',
        'closed',
        'session',
        'price_per_person',
        'total_person',
    ];

      // Slug otomatis
      protected static function boot()
      {
          parent::boot();
  
          static::creating(function ($allotment) {
              $allotment->slug = Str::slug($allotment->swimmingpool_id . '-' . $allotment->date . '-' . time());
          });
      }
  
      // Relasi ke Swimming Pool
      public function swimmingpool()
      {
          return $this->belongsTo(Swimmingpool::class, 'swimmingpool_id');
      }
}

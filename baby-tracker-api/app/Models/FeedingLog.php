<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedingLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'baby_id',
        'feeding_type',
        'food_type',
        'amount',
        'unit',
        'feeding_time',
        'notes'
    ];

    protected $casts = [
        'feeding_time' => 'datetime',
        'amount' => 'decimal:2'
    ];

    public function baby()
    {
        return $this->belongsTo(Baby::class);
    }
}
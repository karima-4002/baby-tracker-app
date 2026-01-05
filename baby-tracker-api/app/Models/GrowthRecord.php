<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrowthRecord extends Model
{
    protected $fillable = [
        'baby_id',
        'measurement_date',
        'weight',
        'height',
        'head_circumference',
        'notes'
    ];

    protected $casts = [
        'measurement_date' => 'date',
    ];

    public function baby()
    {
        return $this->belongsTo(Baby::class);
    }
}

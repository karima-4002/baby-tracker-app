<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    protected $fillable = [
        'baby_id',
        'vaccine_name',
        'scheduled_date',
        'administered_date',
        'status',
        'notes'
    ];

    protected $casts = [
        'scheduled_date' => 'date',
        'administered_date' => 'date',
    ];

    public function baby()
    {
        return $this->belongsTo(Baby::class);
    }
}

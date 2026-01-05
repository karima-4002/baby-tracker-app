<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;

    protected $fillable = [
        'baby_id',
        'title',
        'description',
        'age_months',
        'achieved',
        'achieved_date'
    ];

    protected $casts = [
        'achieved' => 'boolean',
        'achieved_date' => 'date'
    ];

    public function baby()
    {
        return $this->belongsTo(Baby::class);
    }
}
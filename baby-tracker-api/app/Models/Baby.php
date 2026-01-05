<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baby extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'birth_date',
        'gender',
        'birth_weight',
        'birth_height'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'birth_weight' => 'float',
        'birth_height' => 'float'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function milestones()
    {
        return $this->hasMany(Milestone::class);
    }

    public function feedingLogs()
    {
        return $this->hasMany(FeedingLog::class);
    }

    public function vaccinations()
    {
        return $this->hasMany(Vaccination::class);
    }

    public function growthRecords()
    {
        return $this->hasMany(GrowthRecord::class);
    }

    // Calculer l'âge en mois
    public function getAgeMonthsAttribute()
    {
        return $this->birth_date->diffInMonths(now());
    }
}
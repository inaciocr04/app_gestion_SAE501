<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Year_training extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_title'
    ];

    public function trainings(): HasMany
    {
        return $this->hasMany(Training::class, 'year_training_id', 'id');
    }
    public function visits(): HasMany
    {
        return $this->hasMany(Visits::class);
    }
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}

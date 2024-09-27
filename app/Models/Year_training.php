<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year_training extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_title'
    ];

    public function trainings()
    {
        return $this->hasMany(Training::class, 'year_training_id', 'id');
    }
}

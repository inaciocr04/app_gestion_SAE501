<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    public function actual_years()
    {
        return $this->belongsTo(Actual_year::class, 'actual_year_id');
    }
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function year_training()
    {
        return $this->belongsTo(Year_training::class, 'year_training_id');
    }
}

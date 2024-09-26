<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function training_course()
    {
        return $this->belongsTo(Training_course::class);
    }
}

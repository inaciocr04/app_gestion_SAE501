<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actual_year extends Model
{
    use HasFactory;

    public function student_status()
    {
        return $this->hasMany(Student_statu::class, 'actual_year_id','id');
    }

    public function trainings()
    {
        return $this->hasMany(Training::class, 'actual_year_id','id');
    }
}

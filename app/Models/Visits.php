<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visits extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'company_id',
        'teacher_id',
        'year_training_id',
        'note',
        'visit_statu',
        'start_date_visit',
        'end_date_visit',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function year_training()
    {
        return $this->belongsTo(Year_training::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}

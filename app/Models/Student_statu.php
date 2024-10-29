<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student_statu extends Model
{
    use HasFactory;

    protected $fillable = [
        'tutor_id',
        'student_id',
        'teacher_id',
        'statut_id',
        'actual_year_id',
        'start_date_status',
        'end_date_status',
        'start_date_company',
        'end_date_company',
        'status_company',
        'year_training_id',
        'company_id'
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }
    public function statu()
    {
        return $this->belongsTo(Statu::class, 'statut_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function actual_year()
    {
        return $this->belongsTo(Actual_year::class, 'actual_year_id', 'id');
    }

    public function year_training()
    {
        return $this->belongsTo(Year_training::class, 'year_training_id', 'id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}

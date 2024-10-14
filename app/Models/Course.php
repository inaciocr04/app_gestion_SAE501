<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'training_courses_id',
        'start_date',
        'year_training_id',
        'group_td_id',
        'group_tp_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function training_course()
    {
        return $this->belongsTo(Training_course::class, 'training_courses_id');
    }
    public function year_training()
    {
        return $this->belongsTo(Year_training::class, 'year_training_id');
    }
    public function group_td()
    {
        return $this->belongsTo(GroupTD::class, 'group_td_id');
    }
    public function group_tp()
    {
        return $this->belongsTo(GroupTP::class, 'group_tp_id');
    }
}

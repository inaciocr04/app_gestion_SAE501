<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training_course extends Model
{
    use HasFactory;

    protected $fillable =[
        'course_title'
    ];

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }
}

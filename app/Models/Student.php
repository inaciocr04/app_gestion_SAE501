<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'date_birth',
        'student_number',
        'telephone_number',
        'unistra_email',
        'address',
        'postcode',
        'city',
        'personal_email',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function student_statu()
    {
        return $this->hasMany(Student_statu::class, 'student_id');
    }

    public function trainings()
    {
        return $this->hasMany(Training::class, 'student_id', 'id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    public function visits()
    {
        return $this->hasMany(Visits::class);
    }

}

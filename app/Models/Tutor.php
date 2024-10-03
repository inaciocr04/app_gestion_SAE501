<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'civility',
        'firstname',
        'lastname',
        'telephone_number',
        'email',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function students_status()
    {
        return $this->hasMany(Student_statu::class);
    }
}

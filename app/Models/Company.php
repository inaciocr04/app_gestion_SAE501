<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
      'company_name',
      'company_department',
      'company_address',
      'company_postcode',
      'company_city',
      'company_country',
        'company_manager_civility',
        'company_manager_firstname',
        'company_manager_lastname',
        'company_manager_tel_number',
        'company_manager_email',
    ];

    public function tutors()
    {
        return $this->hasMany(Tutor::class);
    }
    public function students_status(): HasMany
    {
        return $this->hasMany(Student_statu::class);
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visits::class);
    }
}

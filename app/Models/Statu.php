<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statu extends Model
{
    use HasFactory;

    protected $table = 'statuts';

    protected $fillable = [
        'statut_title',
    ];
    public function students_status()
    {
        return $this->hasMany(Student_statu::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupTP extends Model
{
    use HasFactory;

    protected $table = 'tp_groups';

    protected $fillable = [
      'group_tp_name'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}

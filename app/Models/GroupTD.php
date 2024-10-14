<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupTD extends Model
{
    use HasFactory;

    protected $table = 'td_groups';

    protected $fillable = [
        'group_td_name'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

}

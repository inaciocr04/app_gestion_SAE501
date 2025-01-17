<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'unistra_email',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function students_status(): HasMany
    {
        return $this->hasMany(Student_statu::class);
    }
    public function visits()
    {
        return $this->hasMany(Visits::class);
    }
}

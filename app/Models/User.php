<?php

namespace App\Models;

// use Illuminate\Contracts\auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }
    public function isTeacher()
    {
        return $this->role === 'teacher';
    }
    public function isManager()
    {
        return $this->role === 'manager';
    }

    public function student(): HasOne
    {
        return $this->hasOne(Student::class, 'user_id');
    }
    public function teacher(): HasOne
    {
        return $this->hasOne(Teacher::class);
    }
    public function visit()
    {
        return $this->hasMany(Visits::class);
    }
}

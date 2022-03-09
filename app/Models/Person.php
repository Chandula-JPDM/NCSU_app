<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Person extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'student';

    protected $fillable = [
        'fname',
        'lname',
        'username',
        'email',
        'password',
        'fullname',
        'initial',
        'address',
        'city',
        'date',
        'regNo',
        'image',
        'faculty_id',
        'batch_id',
        'department_id',
        'isRejected',
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    //protected $guard = 'staff';
    protected $fillable = [
        'fname',
        'lname',
        'username',
        'email',
        'password',
        'fullname',
        'initial',
        'address',
        'phone',
        'date',
        'post',
        'image',
        'faculty_id',
        'department_id',
    ];

    public function faculty(){
        return $this->belongsTo(Faculty::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }
}

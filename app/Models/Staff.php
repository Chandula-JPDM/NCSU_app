<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

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

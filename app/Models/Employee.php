<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'fname',
        'lname',
        'username',
        'email',
        'fullname',
        'initial',
        'address',
        'phone',
        'post',
        'image',
        'editor',
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

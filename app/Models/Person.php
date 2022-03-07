<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
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
        'city',
        'date',
        'regNo',
        'image',
        'faculty_id',
        'batch_id',
        'department_id',
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

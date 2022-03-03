<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class faculty extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'facultyCode',
        'remark',
    ];

    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}

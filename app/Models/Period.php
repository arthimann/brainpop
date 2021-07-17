<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Period extends Model
{
    use HasFactory;

    protected $fillable = [
        'grade',
    ];

    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'user_id');
    }

    public function student()
    {
        return $this->hasMany(Student::class, 'user_id');
    }
}

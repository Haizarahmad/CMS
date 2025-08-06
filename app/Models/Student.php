<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'class_id',
        'name',
        'email',
        'date_of_birth',
        'gender',
        'address',
        'profile_img'
    ];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'student_enroll', 'student_id', 'subject_id');
    }

    public function class()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }

}

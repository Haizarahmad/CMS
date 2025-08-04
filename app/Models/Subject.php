<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name',
    ];

    // Uncomment if you want to define relationships
    // public function exams()
    // {
    //     return $this->belongsToMany(Exam::class);
    // }
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_enroll', 'subject_id', 'student_id');
    }

    public function results()
    {
        return $this->belongsToMany(Result::class, 'subject_result', 'subject_id', 'result_id');
    }
}

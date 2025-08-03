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
}

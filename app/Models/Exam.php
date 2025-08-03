<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'name',
        'date',
    ];

    // public function results()
    // {
    //     return $this->hasMany(Result::class);
    // }

    // public function subjects()
    // {
    //     return $this->belongsToMany(Subject::class);
    // }
}

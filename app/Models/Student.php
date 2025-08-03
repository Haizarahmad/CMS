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
    ];
}

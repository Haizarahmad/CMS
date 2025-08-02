<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function authCheck()
    {
        if (!auth()->check() || auth()->user()->role !== 1) {
            return redirect()->route('login');
        }
    }

    public function index(){
        $this->authCheck();
        return view('teacher.students.index');
    }

    public function addStudentPage(){
        $this->authCheck();
        return view('teacher.students.add-students');
    }
}

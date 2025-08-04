<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        // return view('superadmin.dashboard');
        $user = Auth::user();

        if ($user->role === 0) {
            return view('superadmin.dashboard');
        } elseif ($user->role === 1) {
            $teacher = User::with('classroom')->findOrFail($user->id);

            return view('teacher.dashboard', [
                'teacher' => $teacher,
                'total_students' => $teacher->classroom ? Student::where('class_id', $teacher->classroom->id)->count() : 0,
            ]);
        } else {
            abort(403);
        }
    }

}

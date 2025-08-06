<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\Subject;
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
            return view('superadmin.dashboard', [
                'total_students' => Student::count(),
                'male_count' => $this->calculateAllStudentsByGender('male'),
                'female_count' => $this->calculateAllStudentsByGender('female'),
                'subjectStudentCounts' => $this->calculateAllStudentsBySubject()
            ]);
        } elseif ($user->role === 1) {
            $teacher = User::with('classroom')->findOrFail($user->id);
            $classroomId = $teacher->classroom?->id;

            $hasStudents = $teacher->classroom && Student::where('class_id', $classroomId)->exists();

            return view('teacher.dashboard', [
                'teacher' => $teacher,
                'total_students' => $hasStudents ? Student::where('class_id', $classroomId)->count() : 0,
                'male_count' => $hasStudents ? $this->calculateStudentsByGender($classroomId, 'male') : 0,
                'female_count' => $hasStudents ? $this->calculateStudentsByGender($classroomId, 'female') : 0,
                'subjectStudentCounts' => $hasStudents ? $this->calculateStudentsBySubject($classroomId) : null
            ]);
        } else {
            abort(403);
        }
    }

    public function calculateStudentsByGender($class_id, $gender){
        return Student::where('gender', $gender)
            ->where('class_id', $class_id)
            ->count();
    }

    public function calculateAllStudentsByGender($gender){
        return Student::where('gender', $gender)
            ->count();
    }

    public function calculateStudentsBySubject($class_id){
        $subjects = Subject::withCount(['students' => function ($query) use ($class_id) {
            $query->where('class_id', $class_id);
        }])->get();

        return $subjects->pluck('students_count', 'name')->toArray();
    }

    public function calculateAllStudentsBySubject(){
        $subjects = Subject::withCount(['students' => function ($query) {
            $query;
        }])->get();

        return $subjects->pluck('students_count', 'name')->toArray();      
    }

}

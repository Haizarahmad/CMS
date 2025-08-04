<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

    public function authCheck()
    {
        if (!Auth::user()->can('manage students')) {
            abort(403, 'Unauthorized');
        }
    }

    public function index(){
        $this->authCheck();
        $user = Auth::user();
        $teacher = User::with('classroom')->findOrFail($user->id);
        return view('teacher.students.index', [
            'students' => Student::where('class_id', $teacher->classroom->id)->get()
        ]);
    }

    public function addStudentPage(){
        $this->authCheck();
        return view('teacher.students.add-students',[
            'subjects' => Subject::all(),
        ]);
    }

    public function editStudentPage($id){
        $this->authCheck();
        $student = Student::findOrFail($id);
        return view('teacher.students.edit-students', [
            'student' => $student,
            'subjects' => Subject::all(),
            'enrolled_subjects' => $student->subjects()->get(),
        ]);
    }

    public function postStudent(Request $request){
        $this->authCheck();
        $user = Auth::user();
        $teacher = User::with('classroom')->findOrFail($user->id);
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'address' => 'required|string|max:255',
        ]);

        Student::create([
            'name' => $validated['name'],
            'class_id' => $teacher->classroom->id,
            'email' => $validated['email'],
            'date_of_birth' => $validated['date_of_birth'],
            'gender' => $validated['gender'],
            'address' => $validated['address'],
        ]);

        // Attach subjects if any are selected
        if ($request->has('subjects')) {
            $student = Student::latest()->first();
            $student->subjects()->attach($request->input('subjects'));
        }

        return redirect()->route('students')->with('success', 'Student added successfully!');
    }

    public function updateStudent(Request $request, $id){
        $this->authCheck();
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'address' => 'required|string|max:255',
        ]);

        Student::where('id', $id)->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'date_of_birth' => $validated['date_of_birth'], 
            'gender' => $validated['gender'],
            'address' => $validated['address'],
        ]);

        // Update subjects if any are selected
        if ($request->has('subjects')) {
            $student = Student::findOrFail($id);
            $student->subjects()->sync($request->input('subjects'));
        }

        return redirect()->route('students')->with('success', 'Student updated successfully!');
    }

    public function deleteStudent(Request $request){
        $validated = $request->validate([
            'id' => 'required|integer',
        ]);
        
        Student::where('id', $validated['id'])->delete();

        return redirect()->route('students')->with('success', 'Student deleted successfully!');
    }

}

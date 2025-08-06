<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

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
            'students' => ($teacher->classroom && $teacher->classroom->students) ? Student::where('class_id', $teacher->classroom->id)->get() : collect(),
            'logs' => Activity::causedBy($user)->latest()->get()
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
        try{
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:students,email',
                'date_of_birth' => 'required|date',
                'gender' => 'required|string',
                'address' => 'required|string|max:255',
                'profile_img' => 'file|mimes:jpeg,png,jpg'
            ]);
        } catch (QueryException $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }

        if ($request->hasFile('profile_img')) {
            $file = $request->file('profile_img'); // ← You must get the uploaded file

            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_' . uniqid() . '.' . $extension;  // Create unique filename
            $path = $file->storeAs('Uploads', $filename, 'public'); // Save in storage/app/public/Uploads
        } else {
            $path = null; // Optional: in case no image is uploaded
        }

        $student = Student::create([
            'name' => $validated['name'],
            'class_id' => $teacher->classroom->id,
            'email' => $validated['email'],
            'date_of_birth' => $validated['date_of_birth'],
            'gender' => $validated['gender'],
            'address' => $validated['address'],
            'profile_img' => $path
        ]);

        // Attach subjects if any are selected
        if ($request->has('subjects')) {
            $student = Student::latest()->first();
            $student->subjects()->attach($request->input('subjects'));
        }

        activity()
            ->causedBy(Auth::user())
            ->performedOn($student) // optional, to link to Student model
            ->withProperties(['name' => $student->name])
            ->log('Add a student '. '(' . $student->name . ')');

        return redirect()->route('students')->with('success', 'Student added successfully!');
    }

    public function updateStudent(Request $request, $id)
    {
        $this->authCheck();

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:students,email,' . $id,
                'date_of_birth' => 'required|date',
                'gender' => 'required|string',
                'address' => 'required|string|max:255',
            ]);

            $student = Student::findOrFail($id);
            $updateData = $validated;

            // Handle profile image upload
            if ($request->hasFile('profile_img')) {
                $file = $request->file('profile_img');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_' . uniqid() . '.' . $extension;
                $path = $file->storeAs('Uploads', $filename, 'public');
                $updateData['profile_img'] = $path;
            }

            // Update student data
            $student->update($updateData);

            // Update subjects if provided
            if ($request->has('subjects')) {
                $student->subjects()->sync($request->input('subjects'));
            }

            // Log activity
            activity()
                ->causedBy(Auth::user())
                ->performedOn($student)
                ->withProperties(['name' => $student->name])
                ->log('Updated student: ' . $student->name);

            return redirect()->route('students')->with('success', 'Student updated successfully!');
        } catch (QueryException $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function deleteStudent(Request $request){
        $validated = $request->validate([
            'id' => 'required|integer',
        ]);

        $student = Student::findOrFail($validated['id']);
        
        Student::where('id', $validated['id'])->delete();

        activity()
            ->causedBy(Auth::user())
            ->performedOn($student) // optional, to link to Student model
            ->withProperties(['name' => $student->name])
            ->log('Delete a student '. '(' . $student->name . ')');

        return redirect()->route('students')->with('success', 'Student deleted successfully!');
    }

}

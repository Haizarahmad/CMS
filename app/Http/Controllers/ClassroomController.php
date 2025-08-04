<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ClassroomController extends Controller
{
    public function authCheck()
    {
        if (!Auth::user()->can('manage classrooms')) {
            abort(403, 'Unauthorized');
        }
    }

   public function index(){
        $this->authCheck();
        return view('superadmin.classrooms.index', [
            'teachers' => User::where('role', 1)->get(),
            'classrooms' => Classroom::all()
        ]);
    }

    public function postClassroom(Request $request){
        $this->authCheck();
        $validated = $request->validate([
            'name' => 'required|string|max:255',        
            'teacher_id' => 'required|integer|unique:classrooms,teacher_id',
        ]);

        Classroom::create([
            'name' => $validated['name'],
            'teacher_id' => $validated['teacher_id'],
        ]);

        return redirect()->route('classrooms')->with('success', 'Classroom added successfully!');
    }

    public function updateClassroom(Request $request){
        $this->authCheck();
        $validated = $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string|max:255',        
            'teacher_id' => [
                    'required',
                    'integer',
                    Rule::unique('classrooms', 'teacher_id')->ignore($request->id),
            ],
        ]);

        Classroom::where('id', $validated['id'])->update([
            'name' => $validated['name'],
            'teacher_id' => $validated['teacher_id'],
        ]);

        return redirect()->route('classrooms')->with('success', 'Classroom updated successfully!');
    }

    public function deleteClassroom(Request $request){
        $this->authCheck();
        $validated = $request->validate([
            'id' => 'required|integer',
        ]);

        Classroom::where('id', $validated['id'])->delete();

        return redirect()->route('classrooms')->with('success', 'Classroom deleted successfully!');
    }
}

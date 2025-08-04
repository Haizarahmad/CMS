<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
{
    public function authCheck()
    {
        if (!Auth::user()->can('manage subjects')) {
            abort(403, 'Unauthorized');
        }
    }
    
    public function index(){
        $this->authCheck();
        return view('superadmin.subjects.index', [
            'subjects' => Subject::all()
        ]);
    }

    public function postSubject(Request $request){
        $this->authCheck();
        $validated = $request->validate([
            'name' => 'required|string|max:255',        
        ]);

        Subject::create($validated);

        return redirect()->route('subjects')->with('success', 'Subject added successfully!');
    }

    public function updateSubject(Request $request){
        $this->authCheck();
        $validated = $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
        ]);

        Subject::where('id', $validated['id'])->update([
            'name' => $validated['name'],
        ]);

        return redirect()->route('subjects')->with('success', 'Subject updated successfully!');
    }

    public function deleteSubject(Request $request){
        $this->authCheck();
        $validated = $request->validate([
            'id' => 'required|integer',
        ]);

        Subject::where('id', $validated['id'])->delete();

        return redirect()->route('subjects')->with('success', 'Subject deleted successfully!');
    }
}

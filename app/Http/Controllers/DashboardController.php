<?php

namespace App\Http\Controllers;

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
            return view('teacher.dashboard');
        } else {
            abort(403);
        }
    }

}

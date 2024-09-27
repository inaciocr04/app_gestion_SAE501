<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function someFunction()
    {
        if (Auth::user()->isTeacher()) {
            return view('teacher.index');
        } elseif (Auth::user()->isManager()) {
            return view('manager.index');
        } elseif (Auth::user()->isStudent()) {
            return view('student.index');
        } else {
            return redirect()->route('student.index')->withErrors(['role' => 'Accès non autorisé.']);
        }
    }
}

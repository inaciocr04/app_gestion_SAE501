<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::orderBy('firstname')->get();

        return view('manager.teachers', ['teachers' => $teachers]);
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()->route('manager.teachers');
    }
}

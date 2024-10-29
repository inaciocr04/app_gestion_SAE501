<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Visits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function showStudents()
    {
        $teacher = Auth::user()->teacher;

        $students = $teacher->students_status->map(function ($studentStatu) {
            return $studentStatu->student;
        });


        return view('teacher.student', compact('students'));
    }


}

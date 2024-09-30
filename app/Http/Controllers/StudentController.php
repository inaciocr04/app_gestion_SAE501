<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function students()
    {
        $students = Student::orderBy('student_number')->get();
        return view('global.students', ['students' => $students]);
    }
}

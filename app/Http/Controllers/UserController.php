<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->get();
        return view('user.index', ['users' => $users]);
    }
    public function show($id)
    {
        $user = User::findOrFail($id);

        $student = $user->student;

        return view('student.show', compact('user', 'student'));
    }
}

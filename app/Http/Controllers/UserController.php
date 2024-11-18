<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->get()->groupBy('role');

        return view('user.index', [
            'managers' => $users->get('manager', collect()),
            'teachers' => $users->get('teacher', collect()),
            'students' => $users->get('student', collect()),
        ]);
    }

    public function edit(User $user)
    {
        return redirect()->route('user.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|string|in:student,teacher,manager',
        ]);

        $user->role = $request->role;
        $user->save();

        return redirect()->route('user.index')->with('status', 'Rôle mis à jour avec succès.');
    }

}

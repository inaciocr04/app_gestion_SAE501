<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{

    public function index()
    {
        return view('account.modif');
    }

    public function show()
    {
        $user = Auth::user();

        return view('account.show', ['user' => $user]);
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => [
                'required',
                'string',
                function (string $attribute, mixed $value, Closure $fail) use ($user) {
                    if (! Hash::check($value, $user->password)){
                        $fail("Le :$attribute est erroné.");
                    }
                },
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        $user->update([
            'password' => Hash::make($validated['password'])
        ]);

        return redirect()->route('account_modif')->withStatus('Mot de passe modifié.');
    }
    public function updateAccount(UserRequest $request)
    {
        $user = Auth::user();

        $data = $request->only(['name', 'email']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if (Auth::user()->role === 'manager' && $request->filled('role')) {
            $data['role'] = $request->role;
        }

        $user->update($data);

        return redirect()->route('account_modif')->withStatus('Compte modifié avec succès.');
    }
}

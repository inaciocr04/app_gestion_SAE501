<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;

class UserRole extends Component
{
    public $users;

    public function mount()
    {
        $this->users = User::orderBy('name')->get();
    }

    public function updateRole(Request $request,User $user, $role)
    {

        $request->validate([
            'role' => 'required|string|in:student,teacher,manager',
        ]);


            $user->role = $role;
            $user->save();

            session()->flash('status', 'Rôle mis à jour avec succès.');

        $this->users = User::orderBy('name')->get();
    }
    public function render()
    {
        return view('livewire.user-role');
    }
}

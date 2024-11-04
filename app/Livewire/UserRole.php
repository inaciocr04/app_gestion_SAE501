<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;

class UserRole extends Component
{
    public $users;
    public $roles = [];
    public $notification = '';
    public $showNotification = false;

    public function mount()
    {
        $this->users = User::all();
        foreach ($this->users as $user) {
            $this->roles[$user->id] = $user->role;
        }
    }

    public function updateRole($userId)
    {
        $user = User::find($userId);

        if ($user) {
            $user->role = $this->roles[$userId];
            $user->save();

            $this->notification = 'Le rôle a été mis à jour avec succès.';
            $this->showNotification = true;


        }
    }

    public function render()
    {
        return view('livewire.user-role');
    }
}

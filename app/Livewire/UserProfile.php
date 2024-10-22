<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserProfile extends Component
{
    public $name;
    public $email;
    public $current_password;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email',
        'current_password' => 'required_with:password|string',
        'password' => 'nullable|string|min:8|confirmed',
    ];

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function updateProfile()
    {
        $this->validate();
        $user = Auth::user();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->save();

        session()->flash('status', 'Profil mis à jour avec succès.');
    }

    public function updatePassword()
    {
        $this->validateOnly('current_password', ['current_password' => 'required']);

        $user = Auth::user();

        if (!Hash::check($this->current_password, $user->password)) {
            return session()->flash('error', 'Le mot de passe actuel est incorrect.');
        }

        $this->validateOnly('password', ['password' => 'required|string|min:8|confirmed']);

        $user->password = Hash::make($this->password);
        $user->save();

        session()->flash('status', 'Mot de passe modifié avec succès.');
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}

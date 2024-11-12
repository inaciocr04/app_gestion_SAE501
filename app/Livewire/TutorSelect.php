<?php

namespace App\Livewire;

use App\Models\Tutor;
use Livewire\Component;

class TutorSelect extends Component
{
    public $civility, $firstname, $lastname, $telephone_number, $email;

    protected $rules = [
        'civility' => 'required|string',
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'telephone_number' => 'required|string|max:20',
        'email' => 'required|email|max:255|unique:tutors,email',
    ];


    public function addTutor()
    {
        $this->validate();

        Tutor::create([
            'civility' => $this->civility,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'telephone_number' => $this->telephone_number,
            'email' => $this->email,
            'company_id' => null,
        ]);

        session()->flash('success', 'Tuteur créé avec succès!');
        $this->reset();

    }
    public function render()
    {
        $tutors = Tutor::all();

        return view('livewire.tutor-select', ['tutors' => $tutors]);
    }
}

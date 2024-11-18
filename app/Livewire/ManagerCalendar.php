<?php

namespace App\Livewire;

use App\Models\Teacher;
use App\Models\Visits;
use Livewire\Component;

class ManagerCalendar extends Component
{
    public $teacherId = null;
    public $teachers;
    public $visits = [];

    public function mount()
    {
        $this->teachers = Teacher::all();
        $this->loadVisits();
    }

    public function loadVisits()
    {
        // Si un professeur est sélectionné, récupérer ses visites
        if ($this->teacherId) {
            $this->visits = Visits::where('teacher_id', $this->teacherId)->get();
        } else {
            // Sinon récupérer toutes les visites
            $this->visits = Visits::all();
        }

    }

    public function updatedTeacherId()
    {
        // Recharger les visites lorsqu'un professeur est sélectionné
        $this->loadVisits();
    }


    public function render()
    {
        return view('livewire.manager-calendar');
    }
}

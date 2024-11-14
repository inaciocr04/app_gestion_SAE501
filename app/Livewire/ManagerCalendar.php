<?php

namespace App\Livewire;

use App\Models\Teacher;
use App\Models\Visits;
use Livewire\Component;

class ManagerCalendar extends Component
{
    public $selectedTeacherId;
    public $events = [];

    public function updatedSelectedTeacherId($teacherId)
    {
        $this->loadTeacherEvents($teacherId);
    }

    public function loadTeacherEvents($teacherId)
    {
        // Récupérer les événements pour un professeur spécifique
        $this->events = Visits::where('visit_statu', 'NON')
            ->when($teacherId, function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })
            ->orderBy('start_date_visit', 'desc')
            ->get()
            ->map(function ($visit) {
                return [
                    'id' => $visit->id,
                    'title' => $visit->student->firstname .' '. $visit->student->lastname,
                    'start' => $visit->start_date_visit,
                    'end' => $visit->end_date_visit,
                    'company_name' => $visit->company->company_name ?? 'Non spécifié',
                    'address' => $visit->company->company_address ?? 'Non spécifié',
                    'postcode' => $visit->company->company_postcode ?? 'Non spécifié',
                    'city' => $visit->company->company_city ?? 'Non spécifié',
                ];
            })
            ->toArray();

        // Émettre un événement pour mettre à jour le calendrier côté frontend
        $this->dispatchBrowserEvent('updatedEvents', ['events' => $this->events]);
    }

    public function render()
    {
        $teachers = Teacher::all();
        return view('livewire.manager-calendar', ['events' => $this->events, 'teachers' => $teachers]);
    }
}

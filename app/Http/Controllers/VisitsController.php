<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisitRequest;
use App\Models\Company;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Visits;
use App\Models\Year_training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitsController extends Controller
{
    public function index()
    {
        $teacher = Auth::user()->teacher;

        $visits = Visits::where('teacher_id', $teacher->id)->get();

        $studentsWithDate = $visits->whereNotNull('start_date_visit')->unique('student_id')->count();
        $studentsWithoutDate = $visits->whereNull('start_date_visit')->unique('student_id')->count();

        return view('teacher.visit', [
            'studentsWithDate' => $studentsWithDate,
            'studentsWithoutDate' => $studentsWithoutDate
        ]);
    }

    public function fetchData()
    {
        $teacher = Auth::user()->teacher;

        $visits = Visits::where('teacher_id', $teacher->id)
            ->where('visit_statu', 'NON')
            ->orderBy('start_date_visit', 'desc')
            ->get();

        $events = [];

        foreach ($visits as $visit) {
            $student = $visit->student;

            if ($visit->start_date_visit) {
                $isPastVisit = $visit->start_date_visit < now();

                $eventColor = $isPastVisit ? 'red' : 'green';
                $eventTitle = $isPastVisit
                    ? 'Visite déjà effectuée avec ' . $student->firstname
                    : 'Visite à effectuer avec ' . $student->firstname;

                $events[] = [
                    'student_id' => $student->id,
                    'visit_id' => $visit->id,
                    'title' => $eventTitle,
                    'start' => $visit->start_date_visit,
                    'end' => $visit->end_date_visit,
                    'details' => $visit->note ?? '',
                    'company_name' => $visit->company->company_name ?? 'Non spécifié',
                    'address' => $visit->company->company_address ?? 'Non spécifié',
                    'postcode' => $visit->company->company_postcode ?? 'Non spécifié',
                    'city' => $visit->company->company_city ?? 'Non spécifié',
                    'color' => $eventColor,
                ];
            } else {
                $events[] = [
                    'student_id' => $student->id,
                    'visit_id' => $visit->id,
                    'title' => 'No visit yet for ' . $student->firstname,
                    'start' => null,
                    'end' => null,
                    'details' => 'No visits recorded',
                    'company_name' => 'Non spécifié',
                    'address' => 'Non spécifié',
                    'postcode' => 'Non spécifié',
                    'city' => 'Non spécifié',
                    'color' => 'grey',
                ];
            }
        }

        return response()->json($events);
    }

    public function showManagerVisits()
    {
        return view('manager.visit');
    }

    public function fetchDataManager()
    {
        // Récupérer les visites depuis la base de données
        $visits = Visit::where('visit_statu', 'NON')->orderBy('start_date_visit', 'desc')->get();

        // Formater les données pour renvoyer un tableau d'événements
        $events = [];
        foreach ($visits as $visit) {
            $events[] = [
                'id' => $visit->id, // Ajoute un identifiant unique
                'title' => $visit->title, // Remplace par le titre de l'événement
                'start' => $visit->start_date_visit,
                'end' => $visit->end_date_visit,
                'company_name' => $visit->company->company_name ?? 'Non spécifié',
                'address' => $visit->company->company_address ?? 'Non spécifié',
                'postcode' => $visit->company->company_postcode ?? 'Non spécifié',
                'city' => $visit->company->company_city ?? 'Non spécifié',
            ];
        }

        // Retourner les données au format JSON
        return response()->json($events);
    }


    public function create($studentId)
    {
        $student = Student::findOrFail($studentId);
        $companies = Company::all();
        $yearTrainings = Year_training::all();

        return view('visit.create', compact('student', 'companies', 'yearTrainings'));
    }

    public function store(VisitRequest $request, $studentId)
    {
        $data = $request->validated();
        $data['student_id'] = $studentId;

        $visit = new Visits();
        $visit->fill($data);
        $visit->save();

        return redirect()->route('teacher.student')->with('success', 'Visite programmée avec succès.');
    }
    public function edit($id)
    {
        $visit = Visits::findOrFail($id);
        $student = $visit->student;
        $companies = Company::all();
        $yearTrainings = Year_training::all();

        return view('visit.edit', compact('visit', 'student', 'companies', 'yearTrainings'));
    }

    public function update(VisitRequest $request, $id)
    {
        $visit = Visits::findOrFail($id);

        $data = $request->validated();

        $visit->update($data);

        return redirect()->route('teacher.student')->with('success', 'Visite mise à jour avec succès.');
    }

}

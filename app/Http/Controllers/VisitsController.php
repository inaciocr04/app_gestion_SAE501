<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisitRequest;
use App\Models\Company;
use App\Models\Student;
use App\Models\Visits;
use App\Models\Year_training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitsController extends Controller
{
    public function index()
    {
        return view('teacher.visit'); // Vue pour afficher le calendrier
    }

    public function fetchData()
    {
        $teacher = Auth::user()->teacher;

        $students = $teacher->students_status->unique('student_id')->map(function ($studentStatu) {
            return $studentStatu->student;
        });

        $events = [];

        foreach ($students as $student) {
            $lastVisit = Visits::where('student_id', $student->id)
                ->where('visit_statu', 'NON')
                ->orderBy('start_date_visit', 'desc')
                ->first();

            if ($lastVisit) {
                $isPastVisit = $lastVisit->start_date_visit < now();

                $eventColor = $isPastVisit ? 'red' : 'green';
                $eventTitle = $isPastVisit ? 'Visit déjà effectuée avec ' . $student->firstname : 'Visit à effectuer avec ' . $student->firstname;

                $events[] = [
                    'student_id' => $student->id,
                    'visit_id' => $lastVisit->id,
                    'title' => $eventTitle,
                    'start' => $lastVisit->start_date_visit,
                    'end' => $lastVisit->end_date_visit,
                    'details' => $lastVisit->note ?? '',
                    'company_name' => $lastVisit->company->company_name ?? 'Non spécifié',
                    'address' => $lastVisit->company->company_address ?? 'Non spécifié',
                    'postcode' => $lastVisit->company->company_postcode ?? 'Non spécifié',
                    'city' => $lastVisit->company->company_city ?? 'Non spécifié',
                    'color' => $eventColor,
                ];
            } else {
                $events[] = [
                    'student_id' => $student->id,
                    'visit_id' => null,
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

}

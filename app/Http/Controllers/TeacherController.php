<?php

namespace App\Http\Controllers;

use App\Models\Actual_year;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Visits;
use App\Models\Year_training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::orderBy('firstname')->get();

        return view('manager.teachers', ['teachers' => $teachers]);
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()->route('manager.teachers');
    }

    public function showStudents()
    {
        $teacher = Auth::user()->teacher;

        $currentYear = Actual_year::orderBy('id', 'desc')->first();

        // Récupérer les étudiants associés à ce professeur et à l'année actuelle
        $students = Student::with([
            'trainings.year_training',
            'student_statu',
            'visits'  // Juste récupérons les visites, pas besoin de year_training ici
        ])->whereHas('student_statu', function ($query) use ($teacher, $currentYear) {
            $query->where('teacher_id', $teacher->id)
                ->where('actual_year_id', $currentYear->id);
        })->get();

        $students = $students->filter(function ($student) {
            return $student->visits->contains(function ($visit) {
                return $visit->company_id !== null;
            });
        });

        $studentsMMI2 = $students->filter(function ($student) {
            $lastTraining = $student->trainings->last();

            if ($lastTraining && $lastTraining->year_training->training_title === 'MMI2') {
                $lastVisitMMI2 = $student->visits
                    ->filter(fn($visit) => $visit->year_training_id === $lastTraining->year_training_id && is_null($visit->start_date_visit)) // Vérifier si la date de visite est nulle
                    ->sortByDesc('start_date_visit')
                    ->first();
                if ($lastVisitMMI2) {
                    $student->last_visit = $lastVisitMMI2;
                    return true;
                }
            }
            return false;
        });

        $studentsMMI3 = $students->filter(function ($student) {
            $lastTraining = $student->trainings->last();

            if ($lastTraining && $lastTraining->year_training->training_title === 'MMI3') {
                $lastVisitMMI3 = $student->visits
                    ->filter(fn($visit) => $visit->year_training_id === $lastTraining->year_training_id && is_null($visit->start_date_visit)) // Vérifier si la date de visite est nulle
                    ->sortByDesc('start_date_visit')
                    ->first();
                if ($lastVisitMMI3) {
                    $student->last_visit = $lastVisitMMI3;
                    return true;
                }
            }
            return false;
        });

        return view('teacher.student', compact('studentsMMI2', 'studentsMMI3'));
    }





}

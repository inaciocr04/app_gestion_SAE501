<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Visits;
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

        // Charger les étudiants du teacher connecté avec leurs relations
        $students = Student::with([
            'trainings.year_training', // Charger les formations et l'année de formation
            'student_statu',           // Charger le statut étudiant
            'visits.year_training'     // Charger les visites et l'année de formation
        ])->whereHas('student_statu', function ($query) use ($teacher) {
            // Filtrer pour ne récupérer que les étudiants de cet enseignant
            $query->where('teacher_id', $teacher->id);
        })->get();

        // Filtrer les étudiants pour obtenir uniquement ceux du dernier niveau de formation
        $studentsMMI2 = $students->filter(function ($student) {
            // Obtenir la dernière formation de l'étudiant
            $lastTraining = $student->trainings->last();
            if ($lastTraining && $lastTraining->year_training->training_title === 'MMI2') {
                // Obtenir la dernière visite pour MMI2
                $lastVisitMMI2 = $student->visits
                    ->filter(fn($visit) => $visit->year_training_id === $lastTraining->year_training_id)
                    ->sortByDesc('start_date_visit')
                    ->first();
                if ($lastVisitMMI2) {
                    $student->last_visit = $lastVisitMMI2;
                    return true; // Inclure l'étudiant seulement si la dernière formation est MMI2
                }
            }
            return false;
        });

        $studentsMMI3 = $students->filter(function ($student) {
            // Obtenir la dernière formation de l'étudiant
            $lastTraining = $student->trainings->last();
            if ($lastTraining && $lastTraining->year_training->training_title === 'MMI3') {
                // Obtenir la dernière visite pour MMI3
                $lastVisitMMI3 = $student->visits
                    ->filter(fn($visit) => $visit->year_training_id === $lastTraining->year_training_id)
                    ->sortByDesc('start_date_visit')
                    ->first();
                if ($lastVisitMMI3) {
                    $student->last_visit = $lastVisitMMI3;
                    return true; // Inclure l'étudiant seulement si la dernière formation est MMI3
                }
            }
            return false;
        });

        return view('teacher.student', compact('studentsMMI2', 'studentsMMI3'));
    }







}

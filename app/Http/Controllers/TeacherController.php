<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
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

    public function create()
    {
        return view('teacher.create');
    }

    public function store(TeacherRequest $request)
    {
        $data = $request->validated();
        $teacher = new Teacher();
        $teacher->fill($data);
        $teacher->save();

        return redirect()->route('manager.teachers')->with('success', 'Enseignant ajouté avec succès.');
    }

    public function edit(teacher $teacher)
    {

        return view('teacher.edit', [
            'teacher' => $teacher,
        ]);
    }

    public function update(TeacherRequest $request, teacher $teacher)
    {
        $data = $request->validated();
        $teacher->fill($data);
        $teacher->save();

        return redirect()->route('manager.teachers')->with('success', 'Enseignant mis à jour avec succès.');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()->route('manager.teachers')->with('success', 'Enseignant supprimé avec succès.');
    }

    public function showStudents()
    {
        $teacher = Auth::user()->teacher;
        $currentYear = Actual_year::orderBy('id', 'desc')->first();

        // Récupérer tous les étudiants liés au professeur connecté
        $students = Student::with([
            'trainings.year_training',
            'student_statu',
            'visits'
        ])->whereHas('student_statu', function ($query) use ($teacher, $currentYear) {
            $query->where('teacher_id', $teacher->id)
                ->where('actual_year_id', $currentYear->id);
        })->get();

        $students = $students->filter(function ($student) {
            return $student->visits->contains(function ($visit) {
                return $visit->company_id !== null || $visit->start_date_visit !== null || $visit->company_id == null;
            });
        });

        // Filtrer les étudiants de MMI2
        $studentsMMI2 = $students->filter(function ($student) {
            $lastTraining = $student->trainings->last();

            if ($lastTraining && $lastTraining->year_training->training_title === 'MMI2') {
                $lastVisitMMI2 = $student->visits
                    ->filter(fn($visit) => $visit->year_training_id === $lastTraining->year_training_id)
                    ->sortByDesc('start_date_visit')
                    ->first();
                if ($lastVisitMMI2) {
                    $student->last_visit = $lastVisitMMI2;
                    return true;
                }
            }
            return false;
        });

        // Filtrer les étudiants de MMI3
        $studentsMMI3 = $students->filter(function ($student) {
            $lastTraining = $student->trainings->last();

            if ($lastTraining && $lastTraining->year_training->training_title === 'MMI3') {
                $lastVisitMMI3 = $student->visits
                    ->filter(fn($visit) => $visit->year_training_id === $lastTraining->year_training_id)
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

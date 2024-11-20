<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Actual_year;
use App\Models\Company;
use App\Models\Course;
use App\Models\GroupTD;
use App\Models\GroupTP;
use App\Models\Statu;
use App\Models\Student;
use App\Models\Student_statu;
use App\Models\Teacher;
use App\Models\Training;
use App\Models\Training_course;
use App\Models\Tutor;
use App\Models\Visits;
use App\Models\Year_training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{

    public function index()
    {
        $user = auth()->user();

        $student = Student::with([
            'trainings.year_training',
            'student_statu',
            'visits.year_training',
            'visits.company', // Charger la relation 'company' pour avoir accès aux managers
        ])->where('user_id', $user->id)->firstOrFail();

        // Préparer les visites, statuts, et managers par année de formation
        $visitsByTraining = [];
        $statusByTraining = [];
        $managersByTraining = [];

        foreach (['MMI1', 'MMI2', 'MMI3'] as $trainingTitle) {
            $mmi = $student->trainings->firstWhere('year_training.training_title', $trainingTitle);
            if ($mmi) {
                // Récupérer les visites pour l'année de formation
                $visitsByTraining[$trainingTitle] = $student->visits->filter(function ($visit) use ($mmi) {
                    return $visit->year_training_id === $mmi->year_training_id;
                });

                // Récupérer les statuts pour l'année de formation
                $statusByTraining[$trainingTitle] = $student->student_statu->filter(function ($status) use ($mmi) {
                    return $status->year_training_id === $mmi->year_training_id;
                });

                // Récupérer les informations des managers depuis la relation 'company' des visites
                $managersByTraining[$trainingTitle] = $visitsByTraining[$trainingTitle]->map(function ($visit) {
                    return $visit->company; // Récupérer l'objet company associé à chaque visite
                });
            }
        }

        return view('student.index', [
            'student' => $student,
            'visitsByTraining' => $visitsByTraining,
            'statusByTraining' => $statusByTraining,
            'managersByTraining' => $managersByTraining,
        ]);
    }




    public function students()
    {

        $students = Student::query()
            ->whereHas('student_statu')
            ->whereHas('trainings.year_training')
            ->with([
                'student_statu.teacher',
                'trainings.year_training',
                'courses.training_course',
                'courses.group_td',
                'courses.group_tp',
            ])
            ->get()
            ->groupBy(
                fn($student) => $student->trainings->last()->year_training->training_title
            );
        return view('global.students', [
            'students' => $students,
        ]);
    }

    public function show()
    {
        $user = auth()->user();

        $student = Student::with([
            'trainings.year_training',
            'student_statu',
            'visits.year_training',
            'courses.year_training',
        ])->where('user_id', $user->id)->firstOrFail();

        // Préparer les données pour MMI2 et MMI3
        $dataByTraining = [];

        foreach (['MMI2', 'MMI3'] as $trainingTitle) {
            $mmi = $student->trainings->firstWhere('year_training.training_title', $trainingTitle);

            if ($mmi) {
                $dataByTraining[$trainingTitle] = [
                    'training' => $mmi,
                    'status' => $student->student_statu->filter(function ($status) use ($mmi) {
                        return $status->year_training_id === $mmi->year_training_id;
                    }),
                    'visits' => $student->visits->filter(function ($visit) use ($mmi) {
                        return $visit->year_training_id === $mmi->year_training_id;
                    }),
                    'courses' => $student->courses->filter(function ($course) use ($mmi) {
                        return $course->year_training->training_title === $mmi->year_training->training_title;
                    }),
                ];
            }
        }

        return view('student.show', [
            'student' => $student,
            'dataByTraining' => $dataByTraining,
        ]);
    }


    public function create()
    {
        $year_trainings = Year_Training::all();
        $actual_years = Actual_year::all();
        $training_courses = Training_course::all();
        $td_groups = GroupTD::all();
        $tp_groups = GroupTP::all();
        $tutors = Tutor::all();
        $teachers = Teacher::all();
        $statuts = Statu::all();
        $companies = Company::all();


        return view('student.create', compact(
            'year_trainings',
            'actual_years',
            'training_courses',
            'td_groups',
            'tp_groups',
            'tutors',
            'teachers',
            'statuts',
            'companies',
        ));
    }

    public function store(StudentRequest $request)
    {
        $data = $request->validated();

        $student = new Student();

        $student->fill($data);

        $student->save();

        Training::create([
            'student_id' => $student->id,
            'year_training_id' => $request->input('year_training_id'),
            'actual_year_id' => $request->input('actual_year_id'),
        ]);

        Course::create([
            'student_id' => $student->id,
            'year_training_id' => $request->input('year_training_id'),
            'training_courses_id' => $request->input('training_courses_id'),
            'group_td_id' => $request->input('group_td_id'),
            'group_tp_id' => $request->input('group_tp_id'),
            'start_date' => $request->input('start_date'),
        ]);

        Student_statu::create([
            'student_id' => $student->id,
            'tutor_id' => $request->input('tutors_id'),
            'teacher_id' => $request->input('teachers_id'),
            'company_id' => $request->input('companies_id'),
            'year_training_id' => $request->input('year_training_id'),
            'actual_year_id' => $request->input('actual_year_id'),
            'statut_id' => $request->input('statuts_id'),
            'start_date_status' => $request->input('start_date_status'),
            'end_date_status' => $request->input('end_date_status'),
            'start_date_company' => $request->input('start_date_company'),
            'end_date_company' => $request->input('end_date_company'),
        ]);

        Visits::create([
            'student_id' => $student->id,
            'company_id' => $request->input('companies_id'),
            'teacher_id' => $request->input('teachers_id'),
            'year_training_id' => $request->input('year_training_id'),
            'note' => $request->input('note'),
            'visit_statu' => $request->input('visit_statu'),
            'start_date_visit' => $request->input('start_date_visit'),
            'end_date_visit' => $request->input('end_date_visit'),
        ]);

        return redirect()->route('global.students')->with('success', 'Étudiant créé avec succès.');
    }

    public function edit(Student $student)
    {
        $year_trainings = Year_Training::all();
        $actual_years = Actual_year::all();
        $training_courses = Training_course::all();
        $td_groups = GroupTD::all();
        $tp_groups = GroupTP::all();
        $tutors = Tutor::all();
        $teachers = Teacher::all();
        $statuts = Statu::all();
        $companies = Company::all();

        $training = $student->trainings()->latest()->first();
        $course = $student->courses()->latest()->first();
        $student_statu = $student->student_statu()->latest()->first();
        $visit = $student->visits()->latest()->first();

        $year_training_id = $training ? $training->year_training_id : null;
        $actual_year_id = $training ? $training->actual_year_id : null;
        $group_td_id = $course ? $course->group_td_id : null;
        $group_tp_id = $course ? $course->group_tp_id : null;
        $training_courses_id = $course ? $course->training_courses_id : null;
        $statuts_id = $student_statu ? $student_statu->statut_id : null;
        $tutors_id = $student_statu ? $student_statu->tutor_id : null;
        $companies_id = $student_statu ? $student_statu->company_id : null;
        $teachers_id = $student_statu ? $student_statu->teacher_id : null;


        return view('student.edit', compact(
            'student',
            'year_trainings',
            'actual_years',
            'training_courses',
            'td_groups',
            'tp_groups',
            'tutors',
            'teachers',
            'statuts',
            'companies',
            'year_training_id',
            'actual_year_id',
            'group_td_id',
            'group_tp_id',
            'training_courses_id',
            'statuts_id',
            'tutors_id',
            'companies_id',
            'course',
            'student_statu',
            'visit',
            'teachers_id'
        ));
    }
    public function update(StudentRequest $request, Student $student)
    {
        $data = $request->validated();

        $student->fill($data);
        $student->save();

        $student->trainings()->updateOrCreate(
            [
                'student_id' => $student->id,
                'year_training_id' => $request->input('year_training_id'),
                'actual_year_id' => $request->input('actual_year_id'),],
            [
                'year_training_id' => $request->input('year_training_id'),
                'actual_year_id' => $request->input('actual_year_id'),
            ]
        );

        $student->courses()->updateOrCreate(
            ['id' => $request->input('course_id')],
            [
                'year_training_id' => $request->input('year_training_id'),
                'training_courses_id' => $request->input('training_courses_id'),
                'group_td_id' => $request->input('group_td_id'),
                'group_tp_id' => $request->input('group_tp_id'),
                'start_date' => $request->input('start_date'),
            ]
        );

        try {
            // Vérification si le statut de l'étudiant existe déjà
            $studentStatus = $student->student_statu()
                ->where('year_training_id', $request->input('year_training_id'))
                ->where('actual_year_id', $request->input('actual_year_id'))
                ->where('company_id', $request->input('companies_id'))
                ->first();


            if ($studentStatus) {
                // Mise à jour du statut existant
                $studentStatus->update([
                    'tutor_id' => $request->input('tutors_id'),
                    'teacher_id' => $request->input('teachers_id'),
                    'statut_id' => $request->input('statuts_id'),
                    'end_date_status' => $request->input('end_date_status'),
                    'start_date_company' => $request->input('start_date_company'),
                    'end_date_company' => $request->input('end_date_company'),
                ]);
            } else {
                // Création d'un nouveau statut si aucun n'existe
                $student->student_statu()->create([
                    'student_id' => $student->id,
                    'year_training_id' => $request->input('year_training_id'),
                    'actual_year_id' => $request->input('actual_year_id'),
                    'company_id' => $request->input('companies_id'),
                    'start_date_status' => $request->input('start_date_status'),
                    'tutor_id' => $request->input('tutors_id'),
                    'teacher_id' => $request->input('teachers_id'),
                    'statut_id' => $request->input('statuts_id'),
                    'end_date_status' => $request->input('end_date_status'),
                    'start_date_company' => $request->input('start_date_company'),
                    'end_date_company' => $request->input('end_date_company'),
                ]);
            }

        } catch (\Exception $e) {
            // Gestion des erreurs : log ou rediriger avec un message d'erreur
            Log::error('Erreur lors de la mise à jour ou de la création du statut de l\'étudiant : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour des informations.');
        }




        $visit = $student->visits()
            ->where('student_id', $student->id)
            ->where('year_training_id', $request->input('year_training_id'))
            ->first();

        if ($visit) {
            $visit->update([
                'company_id' => $request->input('companies_id'),
                'teacher_id' => $request->input('teachers_id'),
                'note' => $request->input('note'),
                'visit_statu' => $request->input('visit_statu'),
                'start_date_visit' => $request->input('start_date_visit'),
                'end_date_visit' => $request->input('end_date_visit'),
            ]);
        } else {
            $student->visits()->create([
                'student_id' => $student->id,
                'year_training_id' => $request->input('year_training_id'),
                'company_id' => $request->input('companies_id'),
                'teacher_id' => $request->input('teachers_id'),
                'note' => $request->input('note'),
                'visit_statu' => $request->input('visit_statu'),
                'start_date_visit' => $request->input('start_date_visit'),
                'end_date_visit' => $request->input('end_date_visit'),
            ]);
        }
        return redirect()->route('global.students')->with('success', 'Étudiant mis à jour avec succès.');
    }

    public function destroy(Student $student)
    {

        try {
            // Supprimer les relations associées à l'étudiant
            $student->visits()->delete(); // Supprimer les visites de l'étudiant
            $student->student_statu()->delete(); // Supprimer les statuts de l'étudiant
            $student->courses()->delete(); // Supprimer les cours de l'étudiant
            $student->trainings()->delete(); // Supprimer les formations de l'étudiant

            // Supprimer l'étudiant lui-même
            $student->delete();


            return redirect()->route('global.students')->with('success', 'Étudiant supprimé avec succès.');
        } catch (\Exception $e) {

            Log::error('Erreur lors de la suppression de l\'étudiant : ' . $e->getMessage());
            return redirect()->route('global.students')->with('error', 'Une erreur est survenue lors de la suppression de l\'étudiant.');
        }
    }


}

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
            'visits.year_training'
        ])->where('user_id', $user->id)->firstOrFail();

        $mmi1 = $student->trainings->firstWhere('year_training.training_title', 'MMI1');
        $mmi2 = $student->trainings->firstWhere('year_training.training_title', 'MMI2');
        $mmi3 = $student->trainings->firstWhere('year_training.training_title', 'MMI3');

        $visitsMMI1 = $student->visits->filter(function ($visit) use ($mmi1) {
            return $visit->year_training_id === optional($mmi1)->year_training_id;
        });

        $visitsMMI2 = $student->visits->filter(function ($visit) use ($mmi2) {
            return $visit->year_training_id === optional($mmi2)->year_training_id;
        });

        $visitsMMI3 = $student->visits->filter(function ($visit) use ($mmi3) {
            return $visit->year_training_id === optional($mmi3)->year_training_id;
        });

        $statusMMI1 = $student->student_statu->filter(function ($studentStatu) use ($mmi1){
            return $studentStatu->year_training_id === optional($mmi1)->year_training_id;
        });

        $statusMMI2 = $student->student_statu->filter(function ($studentStatu) use ($mmi2){
            return $studentStatu->year_training_id === optional($mmi2)->year_training_id;
        });
        $statusMMI3 = $student->student_statu->filter(function ($studentStatu) use ($mmi3){
            return $studentStatu->year_training_id === optional($mmi3)->year_training_id;
        });

        return view('student.index', [
            'student' => $student,
            'mmi1' => $mmi1,
            'mmi2' => $mmi2,
            'mmi3' => $mmi3,
            'visitsMMI1' => $visitsMMI1,
            'visitsMMI2' => $visitsMMI2,
            'visitsMMI3' => $visitsMMI3,
            'statusMMI1' => $statusMMI1,
            'statusMMI2' => $statusMMI2,
            'statusMMI3' => $statusMMI3,
        ]);
    }
    public function students()
    {
        $studentsMMI1 = Student::whereHas('trainings', function ($query) {
            $query->whereHas(
                'year_training', function ($subQuery) {
                $subQuery->where('training_title', 'MMI1');
            });
        })->get()->filter(function($student) {
            return $student->trainings->last()->year_training->training_title === 'MMI1';
        });

        $studentsMMI2 = Student::whereHas('trainings', function ($query) {
            $query->whereHas('year_training', function ($subQuery) {
                $subQuery->where('training_title', 'MMI2');
            });
        })->get()->filter(function($student) {
            return $student->trainings->last()->year_training->training_title === 'MMI2';
        });

        $studentsMMI3 = Student::whereHas('trainings', function ($query) {
            $query->whereHas('year_training', function ($subQuery) {
                $subQuery->where('training_title', 'MMI3');
            });
        })->get()->filter(function($student) {
            return $student->trainings->last()->year_training->training_title === 'MMI3';
        });

        return view('global.students', [
            'studentsMMI1' => $studentsMMI1,
            'studentsMMI2' => $studentsMMI2,
            'studentsMMI3' => $studentsMMI3,
        ]);
    }

    public function show()
    {
        $user = auth()->user();

        $student = Student::with([
            'trainings.year_training',
            'student_statu',
            'visits.year_training'
        ])->where('user_id', $user->id)->firstOrFail();

        $mmi2 = $student->trainings->firstWhere('year_training.training_title', 'MMI2');
        $mmi3 = $student->trainings->firstWhere('year_training.training_title', 'MMI3');

        $visitsMMI2 = $student->visits->filter(function ($visit) use ($mmi2) {
            return $visit->year_training_id === optional($mmi2)->year_training_id;
        });

        $visitsMMI3 = $student->visits->filter(function ($visit) use ($mmi3) {
            return $visit->year_training_id === optional($mmi3)->year_training_id;
        });

        $statusMMI2 = $student->student_statu->filter(function ($studentStatu) use ($mmi2) {
            return $studentStatu->year_training_id === optional($mmi2)->year_training_id;
        });

        $statusMMI3 = $student->student_statu->filter(function ($studentStatu) use ($mmi3) {
            return $studentStatu->year_training_id === optional($mmi3)->year_training_id;
        });

        $coursesMMI2 = $student->courses->where('year_training.training_title', 'MMI2');
        $coursesMMI3 = $student->courses->where('year_training.training_title', 'MMI3');

        return view('student.show', [
            'student' => $student,
            'mmi2' => $mmi2,
            'mmi3' => $mmi3,
            'statusMMI2' => $statusMMI2,
            'statusMMI3' => $statusMMI3,
            'visitsMMI2' => $visitsMMI2,
            'visitsMMI3' => $visitsMMI3,
            'coursesMMI2' => $coursesMMI2,
            'coursesMMI3' => $coursesMMI3,
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
            'tutor_id' => $request->input('tutor_id'),
            'teacher_id' => $request->input('teacher_id'),
            'year_training_id' => $request->input('year_training_id'),
            'actual_year_id' => $request->input('actual_year_id'),
            'statut_id' => $request->input('statut_id'),
            'start_date_status' => $request->input('start_date_status'),
            'end_date_status' => $request->input('end_date_status'),
            'start_date_company' => $request->input('start_date_company'),
            'end_date_company' => $request->input('end_date_company'),
        ]);

        Visits::create([
            'student_id' => $student->id,
            'company_id' => $request->input('company_id'),
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

        $trainings = $student->trainings;

        $training = $trainings->last();

        $year_training_id = $training ? $training->year_training_id : null;


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
        ));
    }
    public function update(StudentRequest $request, Student $student)
    {
        $data = $request->validated();

        $student->fill($data);

        $student->save();

        Training::update([
            'student_id' => $student->id,
            'year_training_id' => $request->input('year_training_id'),
            'actual_year_id' => $request->input('actual_year_id'),
        ]);

        Course::update([
            'student_id' => $student->id,
            'year_training_id' => $request->input('year_training_id'),
            'training_courses_id' => $request->input('training_courses_id'),
            'group_td_id' => $request->input('group_td_id'),
            'group_tp_id' => $request->input('group_tp_id'),
            'start_date' => $request->input('start_date'),
        ]);

        Student_statu::update([
            'student_id' => $student->id,
            'tutor_id' => $request->input('tutor_id'),
            'teacher_id' => $request->input('teacher_id'),
            'year_training_id' => $request->input('year_training_id'),
            'actual_year_id' => $request->input('actual_year_id'),
            'statut_id' => $request->input('statut_id'),
            'start_date_status' => $request->input('start_date_status'),
            'end_date_status' => $request->input('end_date_status'),
            'start_date_company' => $request->input('start_date_company'),
            'end_date_company' => $request->input('end_date_company'),
        ]);

        Visits::update([
            'student_id' => $student->id,
            'company_id' => $request->input('company_id'),
            'year_training_id' => $request->input('year_training_id'),
            'note' => $request->input('note'),
            'visit_statu' => $request->input('visit_statu'),
            'start_date_visit' => $request->input('start_date_visit'),
            'end_date_visit' => $request->input('end_date_visit'),
        ]);

        return redirect()->route('global.students')->with('success', 'Étudiant créé avec succès.');
    }
}

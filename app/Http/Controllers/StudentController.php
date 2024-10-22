<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
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
        return view('student.create');
    }

    public function store(StudentRequest $request, Student $student)
    {
        $data = $request->validated();
        $student->fill($data);
        $student->save();

        if ($request->has('trainings')) {
            foreach ($request->trainings as $training) {
                $student->trainings()->create($training);
            }
        }

        // Cours (Courses)
        if ($request->has('courses')) {
            foreach ($request->courses as $course) {
                $student->courses()->create($course);
            }
        }
    }
}

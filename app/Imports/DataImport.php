<?php

namespace App\Imports;

use App\Models\Actual_year;
use App\Models\Company;
use App\Models\Course;
use App\Models\Statu;
use App\Models\Student;
use App\Models\Student_statu;
use App\Models\Teacher;
use App\Models\Training;
use App\Models\Training_course;
use App\Models\Year_training;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {


        $student = Student::updateOrCreate(
            [
                'personal_email' => $row['courriel_perso'] ,
            ],
            [
                'firstname' => $row['prenom'],
                'lastname' => $row['nom'],
                'date_birth' => $row['date_naissance'],
                'student_number' => $row['num_etudiant'],
                'telephone_number' => $row['tel_etudiant'],
                'unistra_email' => $row['courriel_unistra'],
                'address' => $row['adresse_etudiant'],
                'postcode' => $row['code_postal_etudiant'],
                'city' => $row['ville_etudiant'],
            ]
        );

        // Vérifier ou créer le status à l'étudiant
        $status = Statu::firstOrCreate(
            ['statut_title' => $row['statut']]  // Colonne du table excel
        );
        $actualYearId = Actual_year::firstOrCreate(
            ['year_title' => $row['annee']]
        )->id;

        $teacher = Teacher::firstOrCreate(
            [
                'firstname' => $row['prenom_tuteur_universitaire'],
                'lastname' => $row ['nom_tuteur_universitaire'],
                'unistra_email' => $row ['email_unistra_tuteur_universitaire'],
            ]
        );

        $startDateStatus = $row['date_de_debut'];
        $endDateStatus = $row['date_de_fin'];

        Student_statu::updateOrCreate([
            'student_id' => $student->id,
            'statut_id' => $status->id,
            'actual_year_id' => $actualYearId,
            'start_date_status' => $startDateStatus,
            'end_date_status' => $endDateStatus,
            'teacher_id' => $teacher->id,
        ]);

        $YearTraining = Year_training::firstOrCreate(
            ['training_title' => $row['code_diplome']]
        );

        Training::updateOrCreate([
            'student_id' => $student->id,
            'year_training_id' => $YearTraining->id,
            'actual_year_id' => $actualYearId
        ]);

        $TrainingCourses = Training_course::firstOrCreate(
            ['course_title' => $row['parcours']]
        );

        $startDate = now();

        Course::updateOrCreate([
            'student_id' => $student->id,
            'training_courses_id' => $TrainingCourses->id,
            'start_date' => $startDate
        ]);


        return $student;
    }
}

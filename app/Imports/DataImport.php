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
use App\Models\Tutor;
use App\Models\Visits;
use App\Models\Year_training;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class DataImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {

        $dateNaissance = $row['date_naissance'];
        if (is_numeric($dateNaissance)) {
            $dateNaissance = Date::excelToDateTimeObject($dateNaissance)->format('Y-m-d');
        } else {
            $dateNaissance = Carbon::createFromFormat('d/m/Y', $dateNaissance)->format('Y-m-d');
        }


        $student = Student::updateOrCreate(
            [
                'personal_email' => $row['courriel_perso'] ,
            ],
            [
                'firstname' => $row['prenom'],
                'lastname' => $row['nom'],
                'date_birth' => $dateNaissance,
                'student_number' => $row['num_etudiant'],
                'telephone_number' => $row['tel_etudiant'],
                'unistra_email' => $row['courriel_unistra'],
                'address' => $row['adresse_etudiant'],
                'postcode' => $row['code_postal_etudiant'],
                'city' => $row['ville_etudiant'],
            ]
        );

        if (!empty($row['nom_entreprise'])) {
            $Companies = Company::updateOrCreate(
                ['company_name' => $row['nom_entreprise']],
                [
                    'company_name' => $row['nom_entreprise'],
                    'company_department' => $row['service_entreprise'],
                    'company_address' => $row['adresse_entreprise'],
                    'company_postcode' => $row['code_postal_entreprise'],
                    'company_city' => $row['ville_entreprise'],
                    'company_country' => $row['pays'],
                    'company_manager_civility' => $row['civilite_resp'],
                    'company_manager_firstname' => $row['prenom_resp'],
                    'company_manager_lastname' => $row['nom_resp'],
                    'company_manager_tel_number' => $row['num_tel_resp'],
                    'company_manager_email' => $row['mail_resp'],
                ]);
        }else {
            $Companies = null;
        }

        if (!empty($row['prenom_tut'])) {
            $Tutors = Tutor::updateOrCreate(
                ['firstname' => $row['prenom_tut']],
                [
                    'company_id' => $Companies ? $Companies->id : null,
                    'civility' => $row['civilite_tut'],
                    'firstname' => $row['prenom_tut'],
                    'lastname' => $row['nom_tut'],
                    'telephone_number' => $row['num_tel_tut'],
                    'email' => $row['mail_tut'],
                ]);
        }else{
            $Tutors = null;
        }


        $note = $row['suivi_visite'];

        $dates = $row['dates'];
        if (!empty($Companies)) {
            $visits = Visits::updateOrCreate([
                'student_id' => $student->id,
                'company_id' => $Companies ? $Companies->id : null,
                'note' => $note,
                'date' => $dates,
            ]);
        }else{
            $visits = null;
        }

        // Vérifier ou créer le status à l'étudiant
        $status = Statu::firstOrCreate(
            ['statut_title' => $row['statut']]  // Colonne du table excel
        );
        $actualYearId = Actual_year::firstOrCreate(
            ['year_title' => $row['annee']]
        )->id;

        if (!empty($row['prenom_tuteur_universitaire'])) {
            $teacher = Teacher::firstOrCreate(
                [
                    'firstname' => $row['prenom_tuteur_universitaire'],
                    'lastname' => $row ['nom_tuteur_universitaire'],
                    'unistra_email' => $row ['email_unistra_tuteur_universitaire'],
                ]
            );
        }else{
            $teacher = null;
        }

        $startDateStatus = $row['date_de_debut_status'] ?? null;
        if ($startDateStatus) {
            if (is_numeric($startDateStatus)) {
                $startDateStatus = Date::excelToDateTimeObject($startDateStatus)->format('Y-m-d');
            } else {
                $startDateStatus = Carbon::createFromFormat('d/m/Y', $startDateStatus)->format('Y-m-d');
            }
        }else{
            $startDateStatus = now();
        }

        $endDateStatus = $row['date_de_fin_status'] ?? null;
        if ($endDateStatus) {
            if (is_numeric($endDateStatus)) {
                $endDateStatus = Date::excelToDateTimeObject($endDateStatus)->format('Y-m-d');
            } else {
                $endDateStatus = Carbon::createFromFormat('d/m/Y', $endDateStatus)->format('Y-m-d');
            }
        }else{
            $endDateStatus = now()->addYear();
        }

        $startDateCompany = $row['date_de_debut'] ?? null;
        if ($startDateCompany) {
            if (is_numeric($startDateCompany)) {
                $startDateCompany = Date::excelToDateTimeObject($startDateCompany)->format('Y-m-d');
            } else {
                $startDateCompany = Carbon::createFromFormat('d/m/Y', $startDateCompany)->format('Y-m-d');
            }
        }else{
            $startDateCompany = null;
        }

        $endDateCompany = $row['date_de_fin'] ?? null;
        if ($endDateCompany) {
            if (is_numeric($endDateCompany)) {
                $endDateCompany = Date::excelToDateTimeObject($endDateCompany)->format('Y-m-d');
            } else {
                $endDateCompany = Carbon::createFromFormat('d/m/Y', $endDateCompany)->format('Y-m-d');
            }
        }else{
            $endDateCompany = null;
        }
        $statusCompany = $row['statut_en_entreprise'];

        if (!empty($status)) {
            $studentStatu = Student_statu::updateOrCreate(
                [
                    'student_id' => $student->id,
                    'statut_id' => $status->id,
                    'actual_year_id' => $actualYearId,
                    'start_date_status' => $startDateStatus,
                ],
                [
                    'tutor_id' => $Tutors ? $Tutors->id : null,
                    'end_date_status' => $endDateStatus,
                    'teacher_id' =>$teacher ? $teacher->id : null,
                    'start_date_company' => $startDateCompany,
                    'end_date_company' => $endDateCompany,
                    'status_company' => $statusCompany
                ]
            );
        }else{
            $studentStatu = null;
        }

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

        $startDate = $row['date_debut_parcours'] ?? null;
        if ($startDate){
            if (is_numeric($startDate)) {
                $startDate = Date::excelToDateTimeObject($startDate)->format('Y-m-d');
            } else {
                $startDate = Carbon::createFromFormat('d/m/Y', $startDate)->format('Y-m-d');
            }
        }else{
            $startDate = now();
        }

        Course::updateOrCreate([
            'student_id' => $student->id,
            'training_courses_id' => $TrainingCourses->id,
            'start_date' => $startDate
        ]);

        return $student;
    }
}
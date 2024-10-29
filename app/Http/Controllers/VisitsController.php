<?php

namespace App\Http\Controllers;

use App\Models\Visits;
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
        // Récupérer l'enseignant connecté
        $teacher = Auth::user()->teacher;

        // Récupérer tous les étudiants associés à l'enseignant
        $students = $teacher->students_status->map(function ($studentStatu) {
            return $studentStatu->student;
        });

        // Tableau pour stocker les événements
        $events = [];

        // Parcourir chaque étudiant
        foreach ($students as $student) {
            // Récupérer les visites pour cet étudiant avec une date remplie
            $visits = Visits::where('student_id', $student->id)
                ->whereNotNull('start_date_visit') // Ignorer les visites sans date
                ->orderBy('start_date_visit', 'desc') // Tri par date pour obtenir la dernière visite
                ->get(); // Récupérer toutes les visites

            if ($visits->isNotEmpty()) {
                // On prend uniquement la dernière visite
                $lastVisit = $visits->first();

                // Vérifier si la date de la visite est dans le passé ou dans le futur
                $isPastVisit = $lastVisit->start_date_visit < now(); // Compare avec la date actuelle

                // Définir la couleur et le titre selon la date de la visite
                $eventColor = $isPastVisit ? 'red' : 'green';
                $eventTitle = $isPastVisit ? 'Visit déjà effectuer avec ' . $student->firstname .' '. $student->lastname .' en '. $lastVisit->year_training->training_title : 'Visit à éffectué avec ' . $student->firstname;

                $events[] = [
                    'student_id' => $student->id, // ID de l'étudiant
                    'visit_id' => $lastVisit->id, // ID de la visite
                    'title' => $eventTitle, // Titre de la visite
                    'start' => $lastVisit->start_date_visit, // Date de la visite
                    'end' => $lastVisit->end_date_visit, // Date de la visite
                    'details' => $lastVisit->note ?? '', // Détails de la visite (note)
                    'company_name' => $lastVisit->company->company_name ?? 'Non spécifié',
                    'address' => $lastVisit->company->company_address ?? 'Non spécifié',
                    'postcode' => $lastVisit->company->company_postcode ?? 'Non spécifié',
                    'city' => $lastVisit->company->company_city ?? 'Non spécifié',
                    'color' => $eventColor, // Couleur de l'événement
                ];
            } else {
                // Aucune visite trouvée, mais on inclut l'étudiant
                $events[] = [
                    'student_id' => $student->id, // ID de l'étudiant
                    'visit_id' => null, // Aucune visite trouvée
                    'title' => 'No visit yet for ' . $student->firstname,
                    'start' => null, // Pas de date
                    'end' => null, // Pas de date
                    'details' => 'No visits recorded', // Détails indiquant qu'il n'y a pas de visite
                    'company_name' => $lastVisit->company->company_name ?? 'Non spécifié',
                    'address' => $lastVisit->company->company_address ?? 'Non spécifié',
                    'postcode' => $lastVisit->company->company_postcode ?? 'Non spécifié',
                    'city' => $lastVisit->company->company_city ?? 'Non spécifié',
                    'color' => 'grey', // Couleur pour les étudiants sans visites
                ];
            }
        }

        return response()->json($events);
    }




}

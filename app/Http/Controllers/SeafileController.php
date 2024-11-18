<?php

namespace App\Http\Controllers;

use App\Models\Actual_year;
use App\Models\Depot;
use App\Models\Year_training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SeafileController extends Controller
{
    public function upload(Request $request)
    {
        $actual_years = Actual_year::all();
        $year_trainings = Year_training::all();

        $repo_id = $request->query('repo_id');
        return view('depot.upload', [
            'actual_years' => $actual_years,
            'year_trainings' => $year_trainings,
            'repo_id' => $repo_id // On passe le repo_id à la vue
        ]);
    }

    public function uploadFile(Request $request)
    {
        // Validation des données
        $request->validate([
            'file' => 'required|file|max:10240',
            'actual_year_id' => 'required|exists:actual_years,id',
            'year_training_id' => 'required|exists:year_trainings,id',
            'repo_id' => 'required',  // Ajouter la validation du repo_id
        ]);

        // Récupérer le dépôt actif pour l'année et la promotion spécifiées
        $depot = Depot::where('actual_year_id', $request->actual_year_id)
            ->where('year_training_id', $request->year_training_id)
            ->where('actif', true)
            ->first();

        if (!$depot) {
            return back()->withErrors('Aucun dépôt actif trouvé pour cette année et cette promotion.');
        }

        // Utilisation du token API depuis le fichier .env
        $token = '74a2116e617fcd71123310b4d61b74e6086f2204';
        $baseUrl = 'https://seafile.unistra.fr'; // URL de ton serveur Seafile
        $repoId = $request->input('repo_id');  // Récupère le repo_id depuis la requête
        $folderPath = '/MMI1/';

        // Nom du fichier et chemin
        $fileName = $request->file('file')->getClientOriginalName();
        $filePath = $folderPath . $fileName;

        // Envoyer le fichier vers Seafile via l'API
        $response = Http::withToken($token)->attach(
            'file', file_get_contents($request->file('file')->getRealPath()), $fileName
        )->post("{$baseUrl}/api2/repos/{$repoId}/file/?p={$filePath}");
        // Vérifier si l'upload a réussi
        if ($response->successful()) {
            return back()->with('success', 'Fichier importé avec succès dans le dossier Seafile.');
        } else {
            // Si l'upload échoue
            dd($response->body());  // Afficher la réponse complète pour voir l'erreur
            return back()->withErrors('Erreur lors de l\'importation du fichier.');
        }
    }

}


<?php

namespace App\Http\Controllers;

use App\Models\Year_training;
use Illuminate\Http\Request;

class YearTrainingController extends Controller
{
    public function index()
    {
        $year_trainings = Year_training::orderBy('training_title')->get();

        return view('year_training.index', ['year_trainings' => $year_trainings]);
    }

    public function create(Year_training $year_training)
    {
        return view('year_training.create', ['year_training' => $year_training]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'training_title' => 'required|string'
        ]);
        $year_training = new Year_training();
        $year_training->fill($data);
        $year_training->save();

        return redirect()->route('year_training.index')->with('status', 'Année de formation créer.');

    }
    public function edit(Year_training $year_training)
    {
        return view('year_training.edit', ['year_training' => $year_training]);
    }

    public function update(Request $request,Year_training $year_training)
    {
        $request->validate([
            'training_title' => 'required|string'
        ]);

        $year_training->training_title = $request->training_title;
        $year_training->save();

        return redirect()->route('year_training.index')->with('status', 'Annee de formation mis à jour.');
    }

    public function destroy(Year_training $year_training)
    {
        $year_training->delete();
        return redirect()->route('year_training.index')->with('status', 'Année de formation supprimer.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Actual_year;
use App\Models\Depot;
use App\Models\Year_training;
use Illuminate\Http\Request;

class DepotController extends Controller
{
    public function index()
    {
        $depots = Depot::all();
        return view('depot.index', ['depots' => $depots]);
    }

    public function create()
    {
        $actual_years = Actual_year::all();
        $year_trainings = Year_training::all();
        return view('depot.create', ['actual_years' => $actual_years, 'year_trainings' => $year_trainings]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'depot_link' => 'required|string',
            'actual_year_id' => 'required|exists:actual_years,id',
            'year_training_id' => 'required|exists:year_trainings,id',
            'end_date_depot' => 'nullable|date',
        ]);

        Depot::create([
            'depot_link' => $request->depot_link,
            'actual_year_id' => $request->actual_year_id,
            'year_training_id' => $request->year_training_id,
            'actif' => false,
            'end_date_depot' => $request->end_date_depot,
        ]);

        return redirect()->route('manager.depot.index')->with('success', 'Dépôt ajouté avec succès.');
    }

    public function edit($id)
    {
        $depot = Depot::findOrFail($id);
        $actual_years = Actual_year::all();
        $year_trainings = Year_training::all();

        return view('depot.edit', [
            'depot' => $depot,
            'actual_years' => $actual_years,
            'year_trainings' => $year_trainings,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'depot_link' => 'required|string',
            'actual_year_id' => 'required|exists:actual_years,id',
            'year_training_id' => 'required|exists:year_trainings,id',
            'actif' => 'required|boolean',
            'end_date_depot' => 'nullable|date',
            ]);

        $depot = Depot::findOrFail($id);

        $depot->actif = $request->input('actif');

        $depot->update([
            'depot_link' => $request->depot_link,
            'actual_year_id' => $request->actual_year_id,
            'year_training_id' => $request->year_training_id,
            'actif' => $depot->actif,
            'end_date_depot' => $request->end_date_depot,
        ]);

        return redirect()->route('manager.depot.index')->with('success', 'Dépôt mis à jour avec succès.');
    }

    public function destroy(Depot $depot)
    {
        $depot->delete();

        return redirect()->route('manager.depot.index')->with('success', 'Dépôt supprimer avec succès.');
    }


}

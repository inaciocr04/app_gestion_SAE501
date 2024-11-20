<?php

namespace App\Http\Controllers;

use App\Models\Actual_year;
use Illuminate\Http\Request;

class ActualYearController extends Controller
{
    public function index()
    {
        $actual_years = Actual_year::orderBy('year_title', 'desc')->get();
        return view('actual_year.index', ['actual_years' => $actual_years]);
    }

    public function create(Actual_year $actual_year)
    {
        return view('actual_year.create', ['actual_year' => $actual_year]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'year_title' => 'required|string'
        ]);
        $actual_year = new Actual_year();
        $actual_year->fill($data);
        $actual_year->save();

        return redirect()->route('manager.actual_year.index')->with('status', 'Année scolaire créer.');

    }
    public function edit(Actual_year $actual_year)
    {
        return view('actual_year.edit', ['actual_year' => $actual_year]);
    }

    public function update(Request $request,Actual_year $actual_year)
    {
        $request->validate([
            'year_title' => 'required|string'
        ]);

        $actual_year->year_title = $request->year_title;
        $actual_year->save();

        return redirect()->route('manager.actual_year.index')->with('status', 'Annee scolaire mis à jour.');
    }

    public function destroy(Actual_year $actual_year)
    {
        $actual_year->delete();
        return redirect()->route('manager.actual_year.index')->with('status', 'Année scolaire supprimer.');
    }
}

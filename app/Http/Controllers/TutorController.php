<?php

namespace App\Http\Controllers;

use App\Http\Requests\TutorRequest;
use App\Models\Company;
use App\Models\Tutor;
use Illuminate\Http\Request;

class TutorController extends Controller
{
    public function index()
    {
        $tutors = Tutor::orderBy('firstname')->get();

        return view('tutor.index', ['tutors' => $tutors]);
    }

    public function create()
    {
        $companies = Company::all();

        return view('tutor.create', ['companies' => $companies]);
    }

    public function store(TutorRequest $request)
    {
        $data = $request->validated();
        $tutor = new Tutor();
        $tutor->fill($data);
        $tutor->save();

        return redirect()->route('tutor.index')->with('success', 'Tuteur ajouté avec succès.');
    }

    public function edit(Tutor $tutor)
    {
        $companies = Company::all();

        return view('tutor.edit', [
            'tutor' => $tutor,
            'companies' => $companies
        ]);
    }

    public function update(TutorRequest $request, Tutor $tutor)
    {
        $data = $request->validated();
        $tutor->fill($data);
        $tutor->save();

        return redirect()->route('tutor.index')->with('success', 'Tuteur mis à jour avec succès.');
    }

    public function destroy(Tutor $tutor)
    {
        $tutor->delete();

        return redirect()->route('tutor.index')->with('success', 'Tuteur supprimer avec succès.');
    }

}

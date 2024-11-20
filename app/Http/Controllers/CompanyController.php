<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::orderBy('company_name')->get();

        return view('company.index', ['companies' => $companies]);
    }

    public function show(Company $company)
    {
        return view('company.show', ['company' => $company]);
    }

    public function create()
    {
        return view('company.create');
    }
    public function store(CompanyRequest $request)
    {
        $data = $request->validated();
        $company = new Company();
        $company->fill($data);
        $company->save();

        return redirect()->route('manager.company.index')->with('success', 'L\'entreprise à été ajouté avec succès.');

    }

    public function edit(Company $company)
    {
        return view('company.edit', ['company' => $company]);
    }

    public function update(CompanyRequest $request, Company $company)
    {
        $data = $request->validated();
        $company->fill($data);
        $company->save();

        return redirect()->route('manager.company.show', ['company' => $company])->with('success', 'L\'entreprise à été modifié avec succès.');;
    }
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('manager.company.index');
    }
}

<?php

namespace App\Livewire;

use App\Models\Company;
use Livewire\Component;

class CompanySelect extends Component
{
    public $company_name, $company_department, $company_address, $company_postcode, $company_city, $company_country;
    public $company_manager_civility, $company_manager_firstname, $company_manager_lastname, $company_manager_tel_number, $company_manager_email;

    protected $rules = [
        'company_name' => 'required|string',
        'company_department' => 'required|string',
        'company_address' => 'required|string',
        'company_postcode' => 'required|string',
        'company_city' => 'required|string',
        'company_country' => 'required|string',
        'company_manager_civility' => 'required|in:Mr,Mme',
        'company_manager_lastname' => 'required|string',
        'company_manager_firstname' => 'required|string',
        'company_manager_tel_number' => 'required|string',
        'company_manager_email' => 'required|email',
    ];


    public function addCompany()
    {
        $this->validate();

        Company::create([
            'company_name' => $this->company_name,
            'company_department' => $this->company_department,
            'company_address' => $this->company_address,
            'company_postcode' => $this->company_postcode,
            'company_city' => $this->company_city,
            'company_country' => $this->company_country,
            'company_manager_civility' => $this->company_manager_civility,
            'company_manager_firstname' => $this->company_manager_firstname,
            'company_manager_lastname' => $this->company_manager_lastname,
            'company_manager_tel_number' => $this->company_manager_tel_number,
            'company_manager_email' => $this->company_manager_email,
        ]);

        session()->flash('success', 'Entreprise créé avec succès!');
        $this->reset();

    }
    public function render()
    {
        $companies = Company::orderBy('company_name')->get();
        return view('livewire.company-select', ['companies' => $companies]);
    }
}

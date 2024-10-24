<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\Tutor;
use Livewire\Component;

class CreateTutorAndCompany extends Component
{
    public $company_name, $company_department, $company_address, $company_postcode, $company_city, $company_country;
    public $company_manager_civility, $company_manager_firstname, $company_manager_lastname, $company_manager_tel_number, $company_manager_email;
    public $civility, $firstname, $lastname, $telephone_number, $email;

    public function createTutorAndCompany()
    {
        // Validation des données
        $this->validate([
            'company_name' => 'required|string|max:255',
            'company_department' => 'nullable|string|max:255',
            'company_address' => 'required|string|max:255',
            'company_postcode' => 'required|string|max:10',
            'company_city' => 'required|string|max:255',
            'company_country' => 'required|string|max:255',
            'company_manager_civility' => 'required|string',
            'company_manager_firstname' => 'required|string|max:255',
            'company_manager_lastname' => 'required|string|max:255',
            'company_manager_tel_number' => 'required|string|max:20',
            'company_manager_email' => 'required|email|max:255',
            'civility' => 'required|string',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'telephone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        $company = Company::create([
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

        Tutor::create([
            'civility' => $this->civility,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'telephone_number' => $this->telephone_number,
            'email' => $this->email,
            'company_id' => $company->id,
        ]);

        $this->reset();

        session()->flash('success', 'Entreprise et Tuteur créés avec succès.');
    }

    public function render()
    {
        return view('livewire.create-tutor-and-company');
    }
}

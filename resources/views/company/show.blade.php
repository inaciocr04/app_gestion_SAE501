<x-layout title="Détails sur {{$company->company_name}}">
    <div class="flex items-center space-x-7">
        <x-link.back href="{{route('company.index')}}"/>
        <x-link.link name="Modifier" href="{{route('company.edit', ['company' => $company])}}"/>
    </div>

    <ul>
        <li>Nom de l'entreprise: {{$company->company_name}}</li>
        <li>Adresse: {{$company->company_address}}</li>
        <li>Code postal: {{$company->company_postcode}}</li>
        <li>Ville: {{$company->company_city}}</li>
        <li>Département: {{$company->company_department}}</li>
        <li>Pays: {{$company->company_country}}</li>
    </ul>
    <p>Manager de l'entreprise</p>
    <ul>
        <li>Civilité: {{$company->company_manager_civility}}</li>
        <li>Nom: {{$company->company_manager_lastname}}</li>
        <li>Prénom: {{$company->company_manager_firstname}}</li>
        <li>Numéro de téléphone: {{$company->company_manager_tel_number}}</li>
        <li>Adresse email: {{$company->company_manager_email}}</li>
    </ul>
</x-layout>

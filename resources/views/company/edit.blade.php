<x-layout title="Modification | {{$company->company_name}}">
    <a href="{{route('company.show', ['company' => $company])}}">Retour</a>
    <form action="{{route('company.update', ['company' => $company])}}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <x-form.input name_label="Nom de l'entreprise" name="company_name" :value="$company->company_name"/>
        </div>
        <div class="flex justify-evenly">
            <x-form.input name_label="Adresse de l'entreprise" name="company_department" :value="$company->company_department"/>
            <x-form.input name_label="Adresse de l'entreprise" name="company_address" :value="$company->company_address"/>
            <x-form.input name_label="Code postal de l'entreprise" name="company_postcode" :value="$company->company_postcode"/>
        </div>
        <div class="flex justify-evenly">
            <x-form.input name_label="Ville de l'entreprise" name="company_city" :value="$company->company_city"/>
            <x-form.input name_label="Pays de l'entreprise" name="company_country" :value="$company->company_country"/>
        </div>
        <h2>Manager</h2>
        <div class="flex justify-evenly items-center">
            <label>
                Civilité du manager/manageuse
                <select name="company_manager_civility" class="form-select">
                    <option value="{{$company->company_manager_civility}}">{{$company->company_manager_civility}}</option>
                    @if($company->company_manager_civility === 'Monsieur')
                        <option value="Madame">Madame</option>
                    @else
                        <option value="Monsieur">Monsieur</option>
                    @endif
                </select>
            </label>
            <x-form.input name_label="Nom du manager" name="company_manager_lastname" :value="$company->company_manager_lastname"/>
            <x-form.input name_label="Prénom du manager" name="company_manager_firstname" :value="$company->company_manager_firstname"/>
        </div>
        <div class="flex justify-evenly">
            <x-form.input name_label="Numéro de téléphone du manager" type="number" name="company_manager_tel_number" :value="$company->company_manager_tel_number"/>
            <x-form.input name_label="Email du manager" type="email" name="company_manager_email" :value="$company->company_manager_email"/>
        </div>

        <button type="submit">Créer</button>
    </form>
</x-layout>

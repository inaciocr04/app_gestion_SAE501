<x-layout title="Ajout d'une entreprise">
    <a href="{{route('manager.company.index')}}" class="flex items-center">
        <x-heroicon-c-arrow-long-left class="w-6 h-auto" />
        Retour
    </a>
    <form action="{{route('manager.company.store')}}" method="POST">
        @csrf
        <div>
            <x-form.input name_label="Nom de l'entreprise" name="company_name"/>
        </div>
        <div class="flex justify-evenly">
            <x-form.input name_label="Adresse de l'entreprise" name="company_department"/>
            <x-form.input name_label="Adresse de l'entreprise" name="company_address"/>
            <x-form.input name_label="Code postal de l'entreprise" name="company_postcode"/>
        </div>
        <div class="flex justify-evenly">
            <x-form.input name_label="Ville de l'entreprise" name="company_city"/>
            <x-form.input name_label="Pays de l'entreprise" name="company_country"/>
        </div>
        <h2>Manager</h2>
        <div class="flex justify-evenly items-center">
            <label>
                Civilité du manager/manageuse
                <select name="company_manager_civility" class="form-select">
                    <option value="Monsieur">Monsieur</option>
                    <option value="Madame">Madame</option>
                </select>
            </label>
            <x-form.input name_label="Nom du manager" name="company_manager_lastname"/>
            <x-form.input name_label="Prénom du manager" name="company_manager_firstname"/>
        </div>
        <div class="flex justify-evenly">
            <x-form.input name_label="Numéro de téléphone du manager" type="number" name="company_manager_tel_number"/>
            <x-form.input name_label="Email du manager" type="email" name="company_manager_email"/>
        </div>

        <x-form.button name="Créer"/>
    </form>
</x-layout>

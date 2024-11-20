<x-layout title="Ajout d'une entreprise">
    <x-link.back href="{{route('manager.company.index')}}"/>
    <div class="flex flex-col justify-center items-center">
        <form action="{{route('manager.company.store')}}" method="POST" class="space-y-7 w-full">
            @csrf
            <div class=" block lg:flex justify-evenly">
                <div class="space-y-7">
                    <h2 class="font-bold text-lg">Information de l'entreprise</h2>
                    <div>
                        <x-form.input name_label="Nom de l'entreprise" name="company_name"/>
                    </div>
                    <div class="flex flex-col space-y-7">
                        <x-form.input name_label="Département de l'entreprise" name="company_department"/>
                        <x-form.input name_label="Adresse de l'entreprise" name="company_address"/>
                        <x-form.input name_label="Code postal de l'entreprise" name="company_postcode"/>
                    </div>
                    <div class="block lg:flex justify-evenly space-y-4 lg:space-x-4 lg:space-y-0">
                        <x-form.input name_label="Ville de l'entreprise" name="company_city"/>
                        <x-form.input name_label="Pays de l'entreprise" name="company_country"/>
                    </div>
                </div>
                <div class="space-y-7">
                    <h2 class="font-bold text-lg mt-4 lg:mt-0">Manager de l'entreprise</h2>
                    <div class="flex flex-col space-y-7">
                        <label>
                            Civilité du manager/manageuse
                            <select name="company_manager_civility" class="form-select rounded">
                                <option value="Monsieur">Monsieur</option>
                                <option value="Madame">Madame</option>
                            </select>
                        </label>
                        <x-form.input name_label="Nom du manager" name="company_manager_lastname"/>
                        <x-form.input name_label="Prénom du manager" name="company_manager_firstname"/>
                    </div>
                    <div class="flex flex-col space-y-7">
                        <x-form.input name_label="Numéro de téléphone du manager" type="number" name="company_manager_tel_number"/>
                        <x-form.input name_label="Email du manager" type="email" name="company_manager_email"/>
                    </div>
                </div>
            </div>
            <x-form.button name="Créer"/>
        </form>
    </div>
</x-layout>

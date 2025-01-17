<x-layout title="Modification | {{$company->company_name}}">
    <x-link.back href="{{route('manager.company.show', ['company' => $company])}}"/>
    <div class="flex flex-col justify-center items-center">
        <form action="{{route('manager.company.update', ['company' => $company])}}" method="POST" class="space-y-7 w-full">
            @csrf
            @method('PUT')
            <div class="flex justify-evenly">
                <div class="space-y-7">
                    <h2 class="font-bold text-lg">Information de l'entreprise</h2>
                    <div>
                        <x-form.input name_label="Nom de l'entreprise" name="company_name" :value="$company->company_name"/>
                    </div>
                    <div class="flex flex-col space-y-7">
                        <x-form.input name_label="Adresse de l'entreprise" name="company_department" :value="$company->company_department"/>
                        <x-form.input name_label="Adresse de l'entreprise" name="company_address" :value="$company->company_address"/>
                        <x-form.input name_label="Code postal de l'entreprise" name="company_postcode" :value="$company->company_postcode"/>
                    </div>
                    <div class="flex justify-evenly space-x-4">
                        <x-form.input name_label="Ville de l'entreprise" name="company_city" :value="$company->company_city"/>
                        <x-form.input name_label="Pays de l'entreprise" name="company_country" :value="$company->company_country"/>
                    </div>
                </div>
                <div class="space-y-7">
                    <h2 class="font-bold text-lg">Manager</h2>
                    <div class="flex flex-col space-y-7">
                        <label>
                            Civilité du manager/manageuse
                            <select name="company_manager_civility" class="form-select rounded">
                                @if($company->company_manager_civility === 'Monsieur')
                                    <option value="{{$company->company_manager_civility}}">{{$company->company_manager_civility}}</option>
                                    <option value="Madame">Madame</option>
                                @elseif($company->company_manager_civility === 'Madame')
                                    <option value="{{$company->company_manager_civility}}">{{$company->company_manager_civility}}</option>
                                    <option value="Monsieur">Monsieur</option>
                                @else
                                    <option value="">-- Selectionner un genre --</option>
                                    <option value="Madame">Madame</option>
                                    <option value="Monsieur">Monsieur</option>
                                @endif
                            </select>
                        </label>
                        <x-form.input name_label="Nom du manager" name="company_manager_lastname" :value="$company->company_manager_lastname"/>
                        <x-form.input name_label="Prénom du manager" name="company_manager_firstname" :value="$company->company_manager_firstname"/>
                    </div>
                    <div class="flex flex-col space-y-7">
                        <x-form.input name_label="Numéro de téléphone du manager" type="number" name="company_manager_tel_number" :value="$company->company_manager_tel_number"/>
                        <x-form.input name_label="Email du manager" type="email" name="company_manager_email" :value="$company->company_manager_email"/>
                    </div>
                </div>
            </div>
            <x-form.button name="Modifier l'entreprise"/>
        </form>
    </div>
</x-layout>

<x-layout title="Créer un tuteur">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <x-link.back href="{{route('manager.tutor.index')}}"/>
        <div class="flex flex-col justify-center items-center">
            <form action="{{ route('manager.tutor.store') }}" method="POST" class="flex flex-col space-y-7">
                @csrf
                <label>
                    Civilité du tuteur/tuteuse :
                    <select name="civility" class="form-select rounded">
                        <option value="Monsieur">Monsieur</option>
                        <option value="Madame">Madame</option>
                    </select>
                </label>
                <div class="flex flex-col space-y-7">
                    <x-form.input name_label="Nom" name="lastname"/>
                    <x-form.input name_label="Prénom" name="firstname"/>
                    <x-form.input name_label="Numéro de téléphone" name="telephone_number"/>
                    <x-form.input name_label="Adresse email" name="email"/>
                </div>

                <label for="company_id">Entreprise :
                    <select id="company_id" name="company_id" class="form-select rounded">
                        <option value="">-- Sélectionner une entreprise --</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                        @endforeach
                    </select>
                </label>

                <x-form.button name="Créer"/>
            </form>
        </div>
</x-layout>

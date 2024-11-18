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
        <form action="{{ route('manager.tutor.store') }}" method="POST">
        @csrf
        <label>
            Civilité du tuteur/tuteuse :
            <select name="civility" class="form-select">
                <option value="Monsieur">Monsieur</option>
                <option value="Madame">Madame</option>
            </select>
        </label>
        <div>
            <x-form.input name_label="Nom" name="lastname"/>
            <x-form.input name_label="Prénom" name="firstname"/>
            <x-form.input name_label="Numéro de téléphone" name="telephone_number"/>
            <x-form.input name_label="Adresse email" name="email"/>
        </div>

        <label for="company_id">Entreprise :
            <select id="company_id" name="company_id" class="form-select">
                <option value="">-- Sélectionner une entreprise --</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                @endforeach
            </select>
        </label>

        <x-form.button name="Créer"/>
    </form>
</x-layout>

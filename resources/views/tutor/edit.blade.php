<x-layout title="Modifier le tuteur">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <x-link.back href="{{ route('tutor.index') }}"/>

    <form action="{{ route('tutor.update', $tutor->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>
            Civilité du tuteur/tuteuse :
            <select name="civility" class="form-select">
                <option value="Monsieur" {{ $tutor->civility == 'Monsieur' ? 'selected' : '' }}>Monsieur</option>
                <option value="Madame" {{ $tutor->civility == 'Madame' ? 'selected' : '' }}>Madame</option>
            </select>
        </label>

        <div>
            <x-form.input name_label="Nom" name="lastname" :value="$tutor->lastname"/>
            <x-form.input name_label="Prénom" name="firstname" :value="$tutor->firstname"/>
            <x-form.input name_label="Numéro de téléphone" name="telephone_number" :value="$tutor->telephone_number"/>
            <x-form.input name_label="Adresse email" name="email" :value="$tutor->email"/>
        </div>

        <label for="company_id">Entreprise :
            <select id="company_id" name="company_id" class="form-select" required>
                <option value="">-- Sélectionner une entreprise --</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ $tutor->company_id == $company->id ? 'selected' : '' }}>
                        {{ $company->company_name }}
                    </option>
                @endforeach
            </select>
        </label>

        <x-form.button name="Mettre à jour"/>
    </form>
</x-layout>

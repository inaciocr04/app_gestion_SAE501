<x-layout title="Créer un nouveau dépôt">
    <x-link.back href="{{route('manager.depot.index')}}"/>
    <div class="flex flex-col justify-center items-center">
        <form action="{{ route('manager.depot.store') }}" method="POST" class="flex flex-col space-y-7">
            @csrf
                <x-form.input name="name_depot" name_label="Nom du dépot"/>
                <x-form.input name="depot_link" name_label="Lien du dépot"/>
            <label for="actual_year_id" class="w-full">Année actuelle
                <select
                    id="actual_year_id"
                    name="actual_year_id"
                    class="form-select rounded w-full"
                    required>
                    <option value="" disabled selected>-- Sélectionnez une année --</option>
                    @foreach ($actual_years as $actual_year)
                        <option value="{{ $actual_year->id }}">
                            {{ $actual_year->year_title }}
                        </option>
                    @endforeach
                </select>
            </label>
            <div class="form-group">
                <label for="year_training_id" class="w-full">Année de formation
                    <select
                        id="year_training_id"
                        name="year_training_id"
                        class="form-select rounded w-full"
                        required>
                        <option value="" disabled selected>-- Sélectionnez une année de formation --</option>
                        @foreach ($year_trainings as $year_training)
                            <option value="{{ $year_training->id }}">
                                {{ $year_training->training_title }}
                            </option>
                        @endforeach
                    </select>
                </label>
            </div>
            <x-form.input name_label="Date de fin de dépôt" name="end_date_depot" type="date" value=""/>
            <x-form.button name="Créer"/>
        </form>
    </div>
</x-layout>

<x-layout title="Modifier le dépôt {{$depot->name_depot}}">
    <x-link.back href="{{route('manager.depot.index')}}"/>
    <div class="flex flex-col justify-center items-center">
        <form action="{{ route('manager.depot.update', $depot->id) }}" method="POST" x-data="{ actif: {{ $depot->actif }} }" class="flex flex-col space-y-7">
            @csrf
            @method('PUT')

            <x-form.input name="name_depot" name_label="Nom du dépot" :value="old('name_depot', $depot->name_depot)"/>
            <x-form.input name="depot_link" name_label="Lien du dépôt" :value="old('depot_link', $depot->depot_link)"/>

            <label for="actual_year_id" class="w-full">Année actuelle
                <select
                    id="actual_year_id"
                    name="actual_year_id"
                    class="form-select rounded w-full"
                    required>
                    <option value="" disabled>-- Sélectionnez une année --</option>
                    @foreach ($actual_years as $actual_year)
                        <option value="{{ $actual_year->id }}"
                            {{ old('actual_year_id', $depot->actual_year_id) == $actual_year->id ? 'selected' : '' }}>
                            {{ $actual_year->year_title }}
                        </option>
                    @endforeach
                </select>
            </label>

            <label for="year_training_id" class="w-full">Année de formation
                <select
                    id="year_training_id"
                    name="year_training_id"
                    class="form-select rounded w-full"
                    required>
                    <option value="" disabled>-- Sélectionnez une année de formation --</option>
                    @foreach ($year_trainings as $year_training)
                        <option value="{{ $year_training->id }}"
                            {{ old('year_training_id', $depot->year_training_id) == $year_training->id ? 'selected' : '' }}>
                            {{ $year_training->training_title }}
                        </option>
                    @endforeach
                </select>
            </label>
            <x-form.input name_label="Date de fin de dépôt" name="end_date_depot" type="date" value="{{ old('end_date_depot', $depot->end_date_depot) }}"/>


            <div class="flex" x-data="{ toggle: {{ $depot->actif }} }">
                <div class="relative rounded-full w-12 h-6 transition duration-200 ease-linear"
                     :class="[toggle === 1 ? 'bg-green-400' : 'bg-gray-400']">

                    <label for="toggle"
                           class="absolute left-0 bg-white border-2 mb-2 w-6 h-6 rounded-full transition transform duration-100 ease-linear cursor-pointer"
                           :class="[toggle === 1 ? 'translate-x-full border-green-400' : 'translate-x-0 border-gray-400']"></label>

                    <input type="checkbox" id="toggle" name="toggle"
                           class="appearance-none w-full h-full active:outline-none focus:outline-none"
                           :checked="toggle === 1"
                           @click="toggle = toggle === 0 ? 1 : 0; $dispatch('input', toggle)" />
                </div>

                <input type="hidden" name="actif" :value="toggle" />

                <span class="ml-2 text-lg" :class="[toggle === 1 ? 'text-green-500' : 'text-gray-500']">
                    <span x-text="toggle === 1 ? 'Dépôt Actif' : 'Dépôt Inactif'"></span>
                </span>
            </div>


            <button type="submit" class="btn btn-primary">Mettre à jour le dépôt</button>
        </form>
    </div>
</x-layout>

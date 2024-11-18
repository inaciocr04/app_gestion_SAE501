<x-layout title="Modifier le dépôt">
    <div class="container">
        <h1>Modifier le dépôt</h1>

        <form action="{{ route('manager.depot.update', $depot->id) }}" method="POST" x-data="{ actif: {{ $depot->actif }} }">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="depot_link">Lien du dépôt Seafile</label>
                <x-form.input
                    name="depot_link"
                    name_label="Lien du dépôt"
                    :value="old('depot_link', $depot->depot_link)"
                />

                @error('depot_link')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="actual_year_id">Année actuelle</label>
                <select
                    id="actual_year_id"
                    name="actual_year_id"
                    class="form-control @error('actual_year_id') is-invalid @enderror"
                    required>
                    <option value="" disabled>-- Sélectionnez une année --</option>
                    @foreach ($actual_years as $actual_year)
                        <option value="{{ $actual_year->id }}"
                            {{ old('actual_year_id', $depot->actual_year_id) == $actual_year->id ? 'selected' : '' }}>
                            {{ $actual_year->year_title }}
                        </option>
                    @endforeach
                </select>
                @error('actual_year_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="year_training_id">Année de formation</label>
                <select
                    id="year_training_id"
                    name="year_training_id"
                    class="form-control @error('year_training_id') is-invalid @enderror"
                    required>
                    <option value="" disabled>-- Sélectionnez une année de formation --</option>
                    @foreach ($year_trainings as $year_training)
                        <option value="{{ $year_training->id }}"
                            {{ old('year_training_id', $depot->year_training_id) == $year_training->id ? 'selected' : '' }}>
                            {{ $year_training->training_title }}
                        </option>
                    @endforeach
                </select>
                @error('year_training_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
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

                <!-- Champ caché qui contient la valeur de 'actif' -->
                <input type="hidden" name="actif" :value="toggle" />

                <!-- Texte à côté du toggle -->
                <span class="ml-2 text-lg" :class="[toggle === 1 ? 'text-green-500' : 'text-gray-500']">
            <span x-text="toggle === 1 ? 'Dépôt Actif' : 'Dépôt Inactif'"></span>
        </span>
            </div>


            <button type="submit" class="btn btn-primary">Mettre à jour le dépôt</button>
        </form>
    </div>
</x-layout>

<x-layout title="Créer un nouveau dépôt">
        <div>
            <h1>Créer un nouveau dépôt</h1>

            <form action="{{ route('manager.depot.store') }}" method="POST">
                @csrf

                <!-- Champ pour le Repo ID -->
                <div class="form-group">
                    <label for="depot_link">Lien ou ID du dépôt Seafile</label>
                    <x-form.input name="depot_link" name_label="Lien du dépot"/>

                    @error('depot_link')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Sélection de l'année actuelle -->
                <div class="form-group">
                    <label for="actual_year_id">Année actuelle</label>
                    <select
                        id="actual_year_id"
                        name="actual_year_id"
                        class="form-control @error('actual_year_id') is-invalid @enderror"
                        required>
                        <option value="" disabled selected>-- Sélectionnez une année --</option>
                        @foreach ($actual_years as $actual_year)
                            <option value="{{ $actual_year->id }}">
                                {{ $actual_year->year_title }}
                            </option>
                        @endforeach
                    </select>
                    @error('actual_year_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Sélection de l'année de formation -->
                <div class="form-group">
                    <label for="year_training_id">Année de formation</label>
                    <select
                        id="year_training_id"
                        name="year_training_id"
                        class="form-control @error('year_training_id') is-invalid @enderror"
                        required>
                        <option value="" disabled selected>-- Sélectionnez une année de formation --</option>
                        @foreach ($year_trainings as $year_training)
                            <option value="{{ $year_training->id }}">
                                {{ $year_training->training_title }}
                            </option>
                        @endforeach
                    </select>
                    @error('year_training_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <x-form.input name_label="Date de fin de dépôt" name="end_date_depot" type="date" value=""/>


                <!-- Bouton de soumission -->
                <button type="submit" class="btn btn-primary">Créer le dépôt</button>
            </form>
        </div>
</x-layout>

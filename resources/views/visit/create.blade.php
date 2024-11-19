<x-layout title="Programmer une visite">
    <div class="container mt-5">
        <h2 class="text-xl font-bold mb-4">Programmer une visite</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('visit.store', ['studentId' => $student->id]) }}" method="POST">
            @csrf

            <!-- Student ID (champ caché) -->
            <input type="hidden" name="student_id" value="{{ $student->id }}">


            <!-- Year Training ID -->
            <div class="mb-4">
                <label for="year_training_id" class="block text-gray-700 font-bold">Année de formation</label>
                <select name="year_training_id" id="year_training_id" class="w-full px-4 py-2 border rounded" required>
                    <option value="">Sélectionnez une année de formation</option>
                    @foreach ($yearTrainings as $yearTraining)
                        <option value="{{ $yearTraining->id }}" {{ old('year_training_id') == $yearTraining->id ? 'selected' : '' }}>
                            {{ $yearTraining->training_title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Note -->

            <div class="mb-4">
                <label>Visit effectuer ?</label>
                <div class="mt-2">
                    <label class="inline-flex items-center">
                        <input type="radio" name="visit_statu" value="oui" class="form-radio">
                        <span class="ml-2">Oui</span>
                    </label>
                    <label class="inline-flex items-center ml-4">
                        <input type="radio" name="visit_statu" value="non" class="form-radio">
                        <span class="ml-2">Non</span>
                    </label>
                </div>
            </div>
            <!-- Visit Status -->
            <div class="mb-4">
                <label for="visit_statu" class="block text-gray-700 font-bold">Statut de la visite</label>
                <select name="visit_statu" id="visit_statu" class="w-full px-4 py-2 border rounded">
                    <option value="NON" {{ old('visit_statu', 'NON') === 'NON' ? 'selected' : '' }}>NON</option>
                    <option value="OUI" {{ old('visit_statu') === 'OUI' ? 'selected' : '' }}>OUI</option>
                </select>
            </div>

            <div class="flex space-x-20">
                <x-form.input type="datetime-local" name_label="Date de début de la visite" name="start_date_visit" value="{{ old('start_date_visit') }}"/>
                <x-form.input type="datetime-local" name_label="Date de fin de la visite" name="end_date_visit" value="{{ old('end_date_visit') }}"/>
            </div>
            <div class="mb-4">
                <label for="note" class="text-gray-700 font-bold">Notes (Facultatif)</label>
                <textarea name="note" id="note" rows="4" class="form-textarea mt-1 block w-full rounded shadow-sm resize-none h-32"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded font-semibold hover:bg-blue-700">
                    Programmer la visite
                </button>
            </div>
        </form>
    </div>
</x-layout>

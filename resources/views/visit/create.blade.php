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

            <!-- Company ID -->
            <div class="mb-4">
                <label for="company_id" class="block text-gray-700 font-bold">Entreprise (facultatif)</label>
                <select name="company_id" id="company_id" class="w-full px-4 py-2 border rounded">
                    <option value="">Sélectionnez une entreprise</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                            {{ $company->name }}
                        </option>
                    @endforeach
                </select>
            </div>

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
                <label for="note" class="block text-gray-700 font-bold">Note (facultatif)</label>
                <textarea name="note" id="note" rows="3" class="w-full px-4 py-2 border rounded">{{ old('note') }}</textarea>
            </div>

            <!-- Visit Status -->
            <div class="mb-4">
                <label for="visit_statu" class="block text-gray-700 font-bold">Statut de la visite</label>
                <select name="visit_statu" id="visit_statu" class="w-full px-4 py-2 border rounded">
                    <option value="NON" {{ old('visit_statu', 'NON') === 'NON' ? 'selected' : '' }}>NON</option>
                    <option value="OUI" {{ old('visit_statu') === 'OUI' ? 'selected' : '' }}>OUI</option>
                </select>
            </div>

            <!-- Start Date Visit -->
            <div class="mb-4">
                <label for="start_date_visit" class="block text-gray-700 font-bold">Date de début de la visite</label>
                <input type="datetime-local" name="start_date_visit" id="start_date_visit" class="w-full px-4 py-2 border rounded" value="{{ old('start_date_visit') }}">
            </div>

            <!-- End Date Visit -->
            <div class="mb-4">
                <label for="end_date_visit" class="block text-gray-700 font-bold">Date de fin de la visite</label>
                <input type="datetime-local" name="end_date_visit" id="end_date_visit" class="w-full px-4 py-2 border rounded" value="{{ old('end_date_visit') }}">
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

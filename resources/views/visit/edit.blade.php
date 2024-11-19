<x-layout title="Modifier la visite">
    <div class="container mt-5">
        <x-link.back href="{{route('teacher.student')}}"/>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('visit.update', $visit->id) }}" method="POST" class="space-y-7">
            @csrf
            @method('PUT')

            <!-- Student ID (champ caché) -->
            <input type="hidden" name="student_id" value="{{ $visit->student_id }}">

            <div class="flex space-x-20">
                <div class="mb-4 w-full">
                    <label class="block text-gray-700 font-bold w-full">Nom de l'étudiant</label>
                    <p class="border p-2 rounded w-full">{{ $visit->student->firstname .' '. $visit->student->lastname ?? 'N/A' }}</p>
                    <input type="hidden" name="year_training_id" value="{{ $visit->student_id }}">
                </div>

                <div class="mb-4 w-full">
                    <label class="block text-gray-700 font-bold w-full">Année de formation actuelle</label>
                    <p class="border p-2 rounded w-full">{{ $visit->year_training->training_title ?? 'N/A' }}</p>
                    <input type="hidden" name="year_training_id" value="{{ $visit->year_training_id }}">
                </div>
            </div>
            <div class="flex space-x-20">
                <x-form.input type="datetime-local" name_label="Date de début de la visite" name="start_date_visit" value="{{ old('start_date_visit', $visit->start_date_visit) }}"/>
                <x-form.input type="datetime-local" name_label="Date de fin de la visite" name="end_date_visit" value="{{ old('end_date_visit', $visit->end_date_visit) }}"/>
            </div>
            <div class="mb-4">
                <label for="visit_statu" class="block text-gray-700 font-bold">Statut de la visite</label>
                <select name="visit_statu" id="visit_statu" class="w-full px-4 py-2 border rounded">
                    <option value="NON" {{ old('visit_statu', 'non') === 'non' ? 'selected' : '' }}>Non</option>
                    <option value="OUI" {{ old('visit_statu') === 'oui' ? 'selected' : '' }}>Oui</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="note" class="text-gray-700 font-bold">Notes (Facultatif)</label>
                <textarea name="note" id="note" rows="4" class=" form-textarea mt-1 block w-full rounded border resize-none h-32">{{ old('note', $visit->note ) }}</textarea>
            </div>
            <!-- Submit Button -->
            <div class="mt-6">
                <x-form.button name="Mettre à jour la visite"/>

            </div>
        </form>
    </div>
</x-layout>

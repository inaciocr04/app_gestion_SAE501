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

        <form action="{{ route('visit.update', $visit->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Student ID (champ caché) -->
            <input type="hidden" name="student_id" value="{{ $visit->student_id }}">

            <div class="mb-4">
                <label class="block text-gray-700 font-bold">Année de formation actuelle</label>
                <p class="border p-2 rounded">{{ $visit->student->firstname .' '. $visit->student->lastname ?? 'N/A' }}</p>
                <input type="hidden" name="year_training_id" value="{{ $visit->student_id }}">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold">Année de formation actuelle</label>
                <p class="border p-2 rounded">{{ $visit->year_training->training_title ?? 'N/A' }}</p>
                <input type="hidden" name="year_training_id" value="{{ $visit->year_training_id }}">
            </div>

            <!-- Note -->
            <div class="mb-4">
                <label for="note" class="block text-gray-700 font-bold">Note (facultatif)</label>
                <textarea name="note" id="note" rows="3" class="w-full px-4 py-2 border rounded">{{ old('note', $visit->note) }}</textarea>
            </div>

            <!-- Visit Status -->
            <div class="mb-4">
                <label for="visit_statu" class="block text-gray-700 font-bold">Statut de la visite</label>
                <select name="visit_statu" id="visit_statu" class="w-full px-4 py-2 border rounded">
                    <option value="NON" {{ old('visit_statu', $visit->visit_statu) === 'NON' ? 'selected' : '' }}>NON</option>
                    <option value="OUI" {{ old('visit_statu', $visit->visit_statu) === 'OUI' ? 'selected' : '' }}>OUI</option>
                </select>
            </div>

            <!-- Start Date Visit -->
            <div class="mb-4">
                <label for="start_date_visit" class="block text-gray-700 font-bold">Date de début de la visite</label>
                <input type="datetime-local" name="start_date_visit" id="start_date_visit" class="w-full px-4 py-2 border rounded" value="{{ old('start_date_visit', $visit->start_date_visit) }}">
            </div>

            <!-- End Date Visit -->
            <div class="mb-4">
                <label for="end_date_visit" class="block text-gray-700 font-bold">Date de fin de la visite</label>
                <input type="datetime-local" name="end_date_visit" id="end_date_visit" class="w-full px-4 py-2 border rounded" value="{{ old('end_date_visit', $visit->end_date_visit) }}">
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <x-form.button name="Mettre à jour la visite"/>

            </div>
        </form>
    </div>
</x-layout>

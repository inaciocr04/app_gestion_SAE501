<div>
    <!-- Sélection d'enseignant synchronisé avec Livewire -->
    <select id="teacherSelect" wire:model="selectedTeacherId" class="my-2">
        <option value="">Sélectionnez un enseignant</option>
        @foreach($teachers as $teacher)
            <option value="{{ $teacher->id }}">{{ $teacher->firstname }} {{ $teacher->lastname }}</option>
        @endforeach
    </select>

    <div id="managerCalendar"></div>

</div>

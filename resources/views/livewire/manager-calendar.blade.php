<div>
    <select wire:model="teacherId" class="form-control">
        <option value="">Sélectionnez un professeur</option>
        @foreach ($teachers as $teacher)
            <option value="{{ $teacher->id }}">{{ $teacher->firstname }} {{ $teacher->lastname }}</option>
        @endforeach
    </select>

    <!-- Conteneur du calendrier -->
    <div id="managerCalendar"></div>
</div>

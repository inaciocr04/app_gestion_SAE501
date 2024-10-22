<x-layout title="Création student">
    <div class="container">
        <h1>{{ isset($student) ? 'Modifier' : 'Créer' }} un étudiant</h1>

        <form action="{{ isset($student) ? route('students.update', $student->id) : route('students.store') }}" method="POST">
            @csrf
            @if(isset($student))
                @method('PUT')
            @endif

            <!-- Champs de base de l'étudiant -->
            <div>
                <label for="firstname">Prénom</label>
                <input type="text" name="firstname" value="{{ old('firstname', $student->firstname ?? '') }}">
            </div>
            <div>
                <label for="lastname">Nom</label>
                <input type="text" name="lastname" value="{{ old('lastname', $student->lastname ?? '') }}">
            </div>
            <!-- Ajoute d'autres champs ici -->

            <!-- Statut -->
            <div>
                <label for="status">Statut</label>
                <select name="status">
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}" {{ (isset($student) && $student->student_statu && $student->student_statu->first()->status_id == $status->id) ? 'selected' : '' }}>
                            {{ $status->intitule_status }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Formations (Trainings) -->
            <div>
                <label for="trainings">Formations</label>
                <input type="text" name="trainings[]" value="">
                <!-- Ajoute des champs dynamiques pour ajouter plusieurs formations -->
            </div>

            <!-- Cours (Courses) -->
            <div>
                <label for="courses">Cours</label>
                <input type="text" name="courses[]" value="">
                <!-- Ajoute des champs dynamiques pour ajouter plusieurs cours -->
            </div>

            <button type="submit">{{ isset($student) ? 'Mettre à jour' : 'Créer' }}</button>
        </form>
    </div>
</x-layout>

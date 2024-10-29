<x-layout title="Mes étudiants">
    <h1>Liste des étudiants</h1>

    <ul>
        @foreach ($students as $student)
            <li>{{ $student->firstname }} - {{ $student->personal_email }}
            </li>
        @endforeach
    </ul>
</x-layout>

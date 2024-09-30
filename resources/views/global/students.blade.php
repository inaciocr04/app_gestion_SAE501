<x-layout title="Tous les étudiants">
    <ul>
        @foreach($students as $student)
            <li>{{$student->firstname}} {{$student->lastname}}</li>
        @endforeach
    </ul>

</x-layout>

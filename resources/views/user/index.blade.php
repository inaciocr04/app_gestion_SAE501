<x-layout title="Tous les utilisateurs">
    <ul>
        @foreach($users as $user)
            <li>{{$user->name}} / {{$user->email}}</li>
        @endforeach
    </ul>

</x-layout>

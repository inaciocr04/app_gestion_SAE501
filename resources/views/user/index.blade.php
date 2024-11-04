<x-layout title="Tous les utilisateurs">
    <ul class="space-y-4">
        @foreach($users as $user)
            <li class="bg-sixth-color px-8 py-6">{{$user->name}} / {{$user->email}}
                <form action="{{ route('user.update', $user) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')

                    <select name="role" class="ml-4">
                        <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>Etudiants</option>
                        <option value="teacher" {{ $user->role === 'teacher' ? 'selected' : '' }}>Enseignants</option>
                        <option value="manager" {{ $user->role === 'manager' ? 'selected' : '' }}>Manager</option>
                    </select>
                    <x-form.button name="Modifier le rôle"/>
                </form>
            </li>
        @endforeach
    </ul>
</x-layout>

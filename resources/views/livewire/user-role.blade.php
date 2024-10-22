<div>
    <ul class="space-y-4">
        @foreach($users as $user)
            <li class="bg-sixth-color px-8 py-6">
                {{$user->name}} / {{$user->email}}

                <!-- Sélection du rôle -->
                <select wire:model="users.{{ $user->id }}.role" class="ml-4">
                    <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>Etudiants</option>
                    <option value="teacher" {{ $user->role === 'teacher' ? 'selected' : '' }}>Enseignants</option>
                    <option value="manager" {{ $user->role === 'manager' ? 'selected' : '' }}>Manager</option>
                </select>

                <!-- Bouton pour mettre à jour le rôle -->
                <button wire:click="updateRole({{ $user->id }}, users.{{ $user->id }}.role)" class="bg-secondary-color text-white rounded-lg px-4 py-2">
                    Modifier le rôle
                </button>
            </li>
        @endforeach
    </ul>

    @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
            <strong class="font-bold">Succès !</strong>
            <span class="block sm:inline">{{ session('status') }}</span>
        </div>
    @endif
</div>

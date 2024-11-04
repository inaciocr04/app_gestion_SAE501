<div>
    <div x-data="{ show: @entangle('showNotification').defer }"
         x-show="show"
         x-transition:enter="transition transform ease-out duration-300"
         x-transition:enter-start="translate-y-[-100%] opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100"
         x-transition:leave="transition transform ease-in duration-300"
         x-transition:leave-start="translate-y-0 opacity-100"
         x-transition:leave-end="translate-y-[-100%] opacity-0"
         x-init="setTimeout(() => show = false, 5000)"
         class="bg-green-500 text-white p-4 rounded mb-4">
        <p>{{ $notification }}</p> <!-- Affichage de la notification -->
    </div>

    <ul class="space-y-4">
        @foreach($users as $user)
            <li class="bg-sixth-color px-8 py-6">
                {{$user->name}} / {{$user->email}}
                <select wire:model="roles.{{ $user->id }}" class="ml-4" wire:change="updateRole({{ $user->id }})">
                    <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>Etudiants</option>
                    <option value="teacher" {{ $user->role === 'teacher' ? 'selected' : '' }}>Enseignants</option>
                    <option value="manager" {{ $user->role === 'manager' ? 'selected' : '' }}>Manager</option>
                </select>
            </li>
        @endforeach
    </ul>

</div>

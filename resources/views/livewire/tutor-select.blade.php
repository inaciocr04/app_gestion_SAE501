<div>
    <div class="flex items-end space-x-7">
        <label for="tutor" class="text-gray-700 font-bold">Tuteur (Facultatif)
            <select name="tutors_id" id="tutors_id" class="form-select w-full rounded">
                <option value="">-- Sélectionner un tuteur --</option>
                @foreach($tutors as $tutor)
                    <option value="{{ $tutor->id }}">
                        {{ $tutor->firstname }} {{ $tutor->lastname }}
                    </option>
                @endforeach
            </select>
        </label>
        <button type="button" @click="$dispatch('open-tutor-modal', true)" class="!bg-fourth-color text-white p-2 rounded mb-1">
            <x-vaadin-plus class="text-white size-4" />
        </button>
    </div>



    @teleport('body')
    <div x-data="{ open: false, successMessageTutor: '' }"
         @open-tutor-modal.window="open = $event.detail; console.log('Modale ouverte :', open)"
         x-show="open"
         class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50"
         x-transition
         @click.away="open = false"
         style="display: none;">

        <div class="bg-white p-6 rounded-lg shadow-lg z-10 w-full m-6 lg:!w-2/3 lg:m-0 max-h-screen overflow-auto" @click.stop>
            <h2 class="text-lg font-bold mb-4">Créer une Entreprise et un Tuteur</h2>

            @if (session()->has('success'))
                <div class="bg-green-500 text-white p-2 rounded mb-3">
                    {{ session('success') }}
                </div>
            @endif

            <form wire:submit.prevent="addTutor" class="space-y-4">
                <div class="mb-4">
                    <label for="civility" class="block text-sm font-medium text-gray-700">Civilité</label>
                    <select id="civility" wire:model="civility" class="form-control w-full p-2 border border-gray-300 rounded">
                        <option value="">Sélectionner</option>
                        <option value="Monsieur">Monsieur</option>
                        <option value="Madame">Madame</option>
                    </select>
                    @error('civility') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="firstname" class="block text-sm font-medium text-gray-700">Prénom</label>
                    <input type="text" id="firstname" wire:model="firstname" class="form-control w-full p-2 border border-gray-300 rounded">
                    @error('firstname') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="lastname" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" id="lastname" wire:model="lastname" class="form-control w-full p-2 border border-gray-300 rounded">
                    @error('lastname') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="telephone_number" class="block text-sm font-medium text-gray-700">Téléphone</label>
                    <input type="text" id="telephone_number" wire:model="telephone_number" class="form-control w-full p-2 border border-gray-300 rounded">
                    @error('telephone_number') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" wire:model="email" class="form-control w-full p-2 border border-gray-300 rounded">
                    @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end mt-4">
                    <x-form.button name="Créer" type="submit"/>
                    <button type="button" @click="open = false; console.log('Modale fermée :', open)" class="!bg-gray-500 text-white px-4 py-2 rounded-lg ml-2">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endteleport
</div>

<div x-data="{ open: false }">
    <!-- Bouton pour ouvrir la modale -->
    <button @click.prevent="open = true" class="ml-3 bg-blue-500 text-white px-4 py-2 rounded">
        + Nouveau Tuteur et Entreprise
    </button>

    <!-- Modale -->
    <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center" style="display: none;">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-gray-800 opacity-50" @click="open = false"></div>

        <!-- Contenu de la modale -->
        <div class="bg-white p-6 rounded-lg shadow-lg z-10 w-2/3 flex flex-row gap-4 h-fit">
            <h2 class="text-lg font-bold mb-4">Créer une Entreprise et un Tuteur</h2>

            @if (session()->has('success'))
                <div class="bg-green-500 text-white p-2 rounded mb-3">
                    {{ session('success') }}
                </div>
            @endif

            <form wire:submit.prevent="createTutorAndCompany" class="flex space-y-8">
                <!-- Formulaire de l'entreprise et du manager -->
                <div class="flex-1 flex space-x-7 border-r pr-4">
                    <div>
                    <h3 class="font-semibold mb-2">Informations Entreprise</h3>
                    <div class="mb-4">
                        <label for="company_name" class="block text-sm font-medium text-gray-700">Nom de l'entreprise</label>
                        <input type="text" id="company_name" wire:model="company_name" class="form-control w-full p-2 border border-gray-300 rounded">
                        @error('company_name') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="company_department" class="block text-sm font-medium text-gray-700">Département</label>
                        <input type="text" id="company_department" wire:model="company_department" class="form-control w-full p-2 border border-gray-300 rounded">
                        @error('company_department') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="company_address" class="block text-sm font-medium text-gray-700">Adresse</label>
                        <input type="text" id="company_address" wire:model="company_address" class="form-control w-full p-2 border border-gray-300 rounded">
                        @error('company_address') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="company_postcode" class="block text-sm font-medium text-gray-700">Code Postal</label>
                        <input type="text" id="company_postcode" wire:model="company_postcode" class="form-control w-full p-2 border border-gray-300 rounded">
                        @error('company_postcode') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="company_city" class="block text-sm font-medium text-gray-700">Ville</label>
                        <input type="text" id="company_city" wire:model="company_city" class="form-control w-full p-2 border border-gray-300 rounded">
                        @error('company_city') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="company_country" class="block text-sm font-medium text-gray-700">Pays</label>
                        <input type="text" id="company_country" wire:model="company_country" class="form-control w-full p-2 border border-gray-300 rounded">
                        @error('company_country') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    </div>
                    <div>
                    <h3 class="font-semibold mb-2">Informations du Manager</h3>
                    <div class="mb-4">
                        <label for="company_manager_civility" class="block text-sm font-medium text-gray-700">Civilité</label>
                        <select id="company_manager_civility" wire:model="company_manager_civility" class="form-control w-full p-2 border border-gray-300 rounded">
                            <option value="">Sélectionner</option>
                            <option value="Mr">Mr</option>
                            <option value="Mme">Mme</option>
                        </select>
                        @error('company_manager_civility') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="company_manager_firstname" class="block text-sm font-medium text-gray-700">Prénom du Manager</label>
                        <input type="text" id="company_manager_firstname" wire:model="company_manager_firstname" class="form-control w-full p-2 border border-gray-300 rounded">
                        @error('company_manager_firstname') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="company_manager_lastname" class="block text-sm font-medium text-gray-700">Nom du Manager</label>
                        <input type="text" id="company_manager_lastname" wire:model="company_manager_lastname" class="form-control w-full p-2 border border-gray-300 rounded">
                        @error('company_manager_lastname') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="company_manager_tel_number" class="block text-sm font-medium text-gray-700">Téléphone du Manager</label>
                        <input type="text" id="company_manager_tel_number" wire:model="company_manager_tel_number" class="form-control w-full p-2 border border-gray-300 rounded">
                        @error('company_manager_tel_number') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="company_manager_email" class="block text-sm font-medium text-gray-700">Email du Manager</label>
                        <input type="email" id="company_manager_email" wire:model="company_manager_email" class="form-control w-full p-2 border border-gray-300 rounded">
                        @error('company_manager_email') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    </div>
                </div>

                <!-- Formulaire du tuteur -->
                <div class="flex-1 pl-4">
                    <h3 class="font-semibold mb-2">Informations Tuteur</h3>
                    <div class="mb-4">
                        <label for="civility" class="block text-sm font-medium text-gray-700">Civilité</label>
                        <select id="civility" wire:model="civility" class="form-control w-full p-2 border border-gray-300 rounded">
                            <option value="">Sélectionner</option>
                            <option value="Mr">Mr</option>
                            <option value="Mme">Mme</option>
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
                </div>
            </form>

            <!-- Boutons de soumission -->
            <div class="flex justify-end mt-4">
                <button type="submit" class="bg-green-500 text-black px-4 py-2 rounded">
                    Créer
                </button>
                <button type="button" @click="open = false" class="bg-gray-500 text-black px-4 py-2 rounded ml-2">
                    Annuler
                </button>
            </div>
        </div>
    </div>
</div>

<div>
    <div class="flex items-end space-x-7">
        <label for="teacher" class="text-gray-700 font-bold">Entreprise
            <select name="companies_id" id="companies_id" class="form-select w-full rounded">
                <option value="">-- Sélectionner une entreprise --</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}">
                        {{ $company->company_name }}
                    </option>
                @endforeach
            </select>
        </label>
        <button type="button" @click="$dispatch('open-company-modal', true)" class=" !bg-fourth-color text-white p-2 rounded mb-1">
            <x-vaadin-plus class="text-white size-4" />
        </button>
    </div>



    @teleport('body')
    <div x-data="{ open: false }"
         @open-company-modal.window="open = $event.detail; console.log('Modale ouverte :', open)"
         x-show="open"
         class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50"
         x-transition
         @click.away="open = false"
         style="display: none;">

        <div class="bg-white p-6 rounded-lg shadow-lg z-10 w-2/3" @click.stop>
            <h2 class="text-lg font-bold mb-4">Créer une Entreprise et un Tuteur</h2>

            <form wire:submit.prevent="addCompany" class="space-y-4">
                <div class="mb-4">
                    <label for="company_name" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" id="company_name" wire:model="company_name" class="form-control w-full p-2 border border-gray-300 rounded">
                    @error('company_name') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="company_department" class="block text-sm font-medium text-gray-700">Département de l'entreprise</label>
                    <input type="text" id="company_department" wire:model="company_department" class="form-control w-full p-2 border border-gray-300 rounded">
                    @error('company_department') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="company_address" class="block text-sm font-medium text-gray-700">Adresse</label>
                    <input type="text" id="company_address" wire:model="company_address" class="form-control w-full p-2 border border-gray-300 rounded">
                    @error('company_address') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="company_postcode" class="block text-sm font-medium text-gray-700">Code postal</label>
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
                    <h2>Manager</h2>
                <div class="mb-4">
                    <label for="company_manager_civility" class="block text-sm font-medium text-gray-700">Civilité</label>
                    <select id="company_manager_civility" wire:model="company_manager_civility" class="form-control w-full p-2 border border-gray-300 rounded">
                        <option value="">Sélectionner</option>
                        <option value="Mr">Monsieur</option>
                        <option value="Mme">Madame</option>
                    </select>
                    @error('company_manager_civility') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="company_manager_lastname" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" id="company_manager_lastname" wire:model="company_manager_lastname" class="form-control w-full p-2 border border-gray-300 rounded">
                    @error('company_manager_lastname') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="company_manager_firstname" class="block text-sm font-medium text-gray-700">Prénom</label>
                    <input type="text" id="company_manager_firstname" wire:model="company_manager_firstname" class="form-control w-full p-2 border border-gray-300 rounded">
                    @error('company_manager_firstname') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="company_manager_tel_number" class="block text-sm font-medium text-gray-700">N° de téléphone</label>
                    <input type="text" id="company_manager_tel_number" wire:model="company_manager_tel_number" class="form-control w-full p-2 border border-gray-300 rounded">
                    @error('company_manager_tel_number') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="company_manager_email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="company_manager_email" wire:model="company_manager_email" class="form-control w-full p-2 border border-gray-300 rounded">
                    @error('company_manager_email') <span class="text-red-500">{{ $message }}</span> @enderror
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

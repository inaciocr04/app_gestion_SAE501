<div>
    <div class="max-w-4xl mx-auto py-8">
        <h2 class="text-2xl font-bold mb-6">Modifier votre compte</h2>

        <form action="{{ route('account.update') }}" method="POST" class="mb-8">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="text-gray-700 font-bold">Nom</label>
                <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}"
                       class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="text-gray-700 font-bold">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}"
                       class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-6">
                <x-form.button name="Modifier votre profil" class="font-bold"/>
            </div>
        </form>

        <form action="{{ route('account_modif') }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label for="current_password" class="text-gray-700 font-bold">Mot de passe actuel</label>
                <input type="password" name="current_password" id="current_password"
                       class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('current_password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="text-gray-700 font-bold">Nouveau mot de passe</label>
                <input type="password" name="password" id="password"
                       class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="text-gray-700 font-bold">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <div class="mt-6">
                <x-form.button name="Modifier votre mot de passe" class="font-bold"/>
            </div>
        </form>
    </div>
</div>

<x-layout title="Modifier votre compte">
    <form action="{{ route('account_modif') }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h1 class="text-base font-semibold leading-7 text-gray-900">Mot de passe</h1>
                <p class="mt-1 text-sm leading-6 text-gray-600">Vous pouvez modifier votre mot de passe pour vos futures connexions.</p>

                <div class="mt-10 space-y-8 md:w-2/3 w-full">
                    <x-input type="password" name="current_password" label="Mot de passe actuel" />
                    <x-input type="password" name="password" label="Nouveau mot de passe" />
                    <x-input type="password" name="password_confirmation" label="Confirmation du nouveau mot de passe" />
                </div>
            </div>
        </div>
        <div class=" flex items-center justify-end ">
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm ">Modifier</button>
        </div>
    </form>
</x-layout>

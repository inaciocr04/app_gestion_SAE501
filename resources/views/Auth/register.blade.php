<x-auth-layout title="Inscription" :action="route('register')" submitMessage="Inscription" titleForm="Inscrivez-vous">
    <x-input name="name" label="Nom complet" />
    <x-input name="email" label="Adresse e-mail" type="email" />
    <x-input name="password" label="Mot de passe" type="password" />
    <x-input name="password_confirmation" label="Confirmation du mot de passe" type="password" />
    <div>
        <a href="{{Route('login')}}">Si vous êtes déjà inscrit cliquer ici</a>
    </div>
    <div>
        <label for="is_teacher">Êtes-vous enseignant ?</label>
        <input type="checkbox" name="is_teacher" value="1">
    </div>

    <div>
        <label for="is_manager">Êtes-vous gestionnaire ?</label>
        <input type="checkbox" name="is_manager" value="1">
    </div>
</x-auth-layout>

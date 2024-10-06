<x-layout title="Mon compte">
    <h1>Détails de l'utilisateur</h1>

    <p>Nom : {{ $user->name }}</p>
    <p>Email : {{ $user->email }}</p>
    <p>Date de création du compte : {{ $user->created_at }}</p>
</x-layout>

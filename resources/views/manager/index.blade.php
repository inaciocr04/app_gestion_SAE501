<x-layout title="Tableau de Bord Gestionnaire">
    <h1>Bienvenue sur le tableau de bord des Gestionnaire</h1>
    <p>Ceci est la page réservée aux gestionnaire.</p>

    <h2>Importer des données</h2>
    @if(session('success'))
        <div class="bg-secondary-color">
            <p class="text-white">{{ session('success') }}</p>
        </div>
    @endif

    <form action="{{Route('manager.import')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required>
        <button type="submit">Importer</button>
    </form>
</x-layout>

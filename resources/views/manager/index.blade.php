<x-layout title="Tableau de Bord Gestionnaire">
    <div class=" mx-auto px-4 py-8">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Bienvenue sur le tableau de bord du Gestionnaire</h1>
        <p class="text-md text-gray-600 mb-6">
            Ce tableau de bord est conçu pour vous permettre de gérer efficacement toutes les données liées à votre rôle.
            En tant que gestionnaire, vous avez accès à un ensemble d'outils pour importer, consulter et organiser les
            informations clés concernant les étudiants, enseignants, entreprises, groupes, années académiques, et dépôts.
            Vous pouvez également superviser les visites en entreprise effectuées par les enseignants et gérer les rôles
            des utilisateurs du système.
        </p>

        <section class="mb-4">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Importer des données</h2>
            <p class="text-md text-gray-600 mb-4">
                Vous pouvez importer des fichiers contenant vos données directement depuis cette page. Les formats acceptés
                sont <strong>Excel (.xlsx, .xls)</strong> et <strong>CSV (.csv)</strong>. Suivez les étapes ci-dessous :
            </p>
            <ol class="list-decimal pl-6 space-y-2 text-md text-gray-600 mb-6">
                <li>Cliquez sur <em>Choisir un fichier</em> pour sélectionner un document à importer.</li>
                <li>Assurez-vous que le fichier contient des informations correctement formatées pour être prises en charge par le système.
                    <a href="https://docs.google.com/spreadsheets/d/11a1P70qdiHsgycErRcUwmSiHlNW5OIF2/edit?usp=sharing&ouid=115789435045159120653&rtpof=true&sd=true" class="border-b border-secondary-color text-secondary-color font-bold">Exemple</a>
                </li>
                <li>Appuyez sur le bouton <strong>Importer</strong> pour soumettre votre fichier.</li>
            </ol>
            <p class="text-lg text-gray-600 mb-4">
                Une fois importées, les données seront automatiquement intégrées dans le système et disponibles pour consultation et gestion.
            </p>

            <form action="{{Route('manager.import')}}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div class="flex flex-col space-y-2">
                    <label for="file" class="text-lg font-medium text-gray-700">Sélectionner un fichier</label>
                    <input type="file" name="file" id="file" required class="border border-gray-300 rounded-md p-2">
                </div>
                <x-form.button type="submit" name="Importer" class="bg-red-600"/>

            </form>
        </section>

    </div>
</x-layout>

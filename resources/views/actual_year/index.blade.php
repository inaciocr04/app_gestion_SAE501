<x-layout title="Année scolaire">
    <div class="flex space-x-2">
        <x-link.back href="{{route('manager.groupes.index')}}"/>
        <x-link.link name="Créer une année" href="{{route('manager.actual_year.create')}}"/>
    </div>
    <table id="tableYear">
        <thead>
        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Année</th>
        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action</th>
        </thead>
        <tbody>
        @foreach($actual_years as $actual_year)
            <tr class="flex justify-between items-center">
                <td>{{$actual_year->year_title}}</td>
                <td class="flex space-x-7">
                    <x-link.link name="Modifier" href="{{route('manager.actual_year.edit', ['actual_year' => $actual_year])}}"/>
                    <form action="{{route('manager.actual_year.destroy', ['actual_year' => $actual_year])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-form.button name="Supprimer" class="bg-red-600"/>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</x-layout>

<script>
    $(document).ready(function () {
        $('#tableYear').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            pageLength: 15,
            lengthMenu: [15, 10, 5],
            order: [[0, 'desc']],
            language: {
                "sEmptyTable": "Aucune donnée disponible dans le tableau",
                "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ entreprises",
                "sInfoEmpty": "Affichage de 0 à 0 sur 0 entrées",
                "sInfoFiltered": "(filtré de _MAX_ entrées au total)",
                "sLengthMenu": "Afficher _MENU_ entreprises",
                "sLoadingRecords": "Chargement...",
                "sProcessing": "Traitement...",
                "sSearch": "Recherche:",
                "sZeroRecords": "Aucun résultat trouvé",
                "oPaginate": {
                    "sFirst": "Premier",
                    "sLast": "Dernier",
                    "sNext": "Suivant",
                    "sPrevious": "Précédent"
                },
                "oAria": {
                    "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                    "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
                }
            }
        });
    });
</script>

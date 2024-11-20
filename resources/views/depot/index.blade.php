<x-layout title="Dépot">
    <x-link.link href="{{route('manager.depot.create')}}" name="Créer un nouveau dépot" class="mb-6"/>
    <table id="tableDepot">
        <thead>
        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nom du dépôt</th>
        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Lien du dépôt</th>
        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Statut du dépôt</th>
        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action</th>

        </thead>
        <tbody>
        @foreach($depots as $depot)
            <tr>
                <td>{{$depot->name_depot}}</td>
                <td>
                    <a href="{{$depot->depot_link}}">{{$depot->depot_link}}</a>
                </td>
                @if($depot->actif === 0)
                    <td>Dépôt inactif</td>
                @else
                    <td>Dépôt actif</td>
                @endif

                <td class="flex space-x-2">
                    <x-link.link href="{{route('manager.depot.edit', ['depot' => $depot])}}" name="Modifier"/>
                    <form action="{{route('manager.depot.destroy', ['depot' => $depot])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-form.button name="Supprimer"/>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-layout>

<script>
    $(document).ready(function () {
        $('#tableDepot').DataTable({
            paging: true,
            searching: true,
            scrollY: '400px',
            scrollX: true,
            responsive: {
                details: {
                    type: 'inline',
                    target: 'tr'
                }
            },
            autoWidth: false,
            ordering: true,
            pageLength: 15,
            lengthMenu: [15, 10, 5],
            language: {
                "sEmptyTable": "Aucune donnée disponible dans le tableau",
                "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ dépôts",
                "sInfoEmpty": "Affichage de 0 à 0 sur 0 entrées",
                "sInfoFiltered": "(filtré de _MAX_ entrées au total)",
                "sLengthMenu": "Afficher _MENU_ dépôts",
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

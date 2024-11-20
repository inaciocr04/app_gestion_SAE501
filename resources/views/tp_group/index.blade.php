<x-layout title="Groupes TP">
    <div class="flex space-x-2 mb-6">
        <x-link.back href="{{route('manager.groupes.index')}}"/>
        <x-link.link name="Créer un groupe TP" href="{{route('manager.tp_group.create')}}"/>
    </div>
    <table id="tableTP">
        <thead>
        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nom</th>
        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action</th>
        </thead>
        <tbody>
        @foreach($tp_groups as $tp_group)
            <tr>
                <td>{{$tp_group->tp_name}}</td>
                <td class="flex space-x-7">
                    <x-link.link name="Modifier" href="{{route('manager.tp_group.edit', ['tp_group' => $tp_group])}}"/>
                    <form action="{{route('manager.tp_group.destroy', ['tp_group' => $tp_group])}}" method="POST">
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
        $('#tableTP').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            scrollY: '400px',
            scrollX: true,
            responsive: {
                details: {
                    type: 'inline',
                    target: 'tr'
                }
            },
            autoWidth: false,
            pageLength: 15,
            lengthMenu: [15, 10, 5],
            order: [[0, 'asc']],
            language: {
                "sEmptyTable": "Aucune donnée disponible dans le tableau",
                "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ groupes",
                "sInfoEmpty": "Affichage de 0 à 0 sur 0 entrées",
                "sInfoFiltered": "(filtré de _MAX_ entrées au total)",
                "sLengthMenu": "Afficher _MENU_ groupes",
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

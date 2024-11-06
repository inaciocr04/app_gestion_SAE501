<x-layout title="Liste des tuteurs">
    <x-link.back href="{{route('manager.company.index')}}"/>
    <x-link.link name="Créer un tuteur" href="{{route('manager.tutor.create')}}" class="mb-5"/>
    <table id="tableTeacher">
                <thead>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Civilité</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nom</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Prénom</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Numéro de téléphone</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Adresse email</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action</th>
                </thead>
                <tbody>
                @foreach($tutors as $tutor)
                    <tr>
                        <td> {{$tutor->civility}}</td>
                        <td> {{$tutor->lastname}}</td>
                        <td>{{ $tutor->firstname }}</td>
                        <td>{{ $tutor->telephone_number }}</td>
                        <td>{{ $tutor->email }}</td>
                        <td class="flex space-x-2">
                            <x-link.link name="Modifier" href="{{route('manager.tutor.edit', ['tutor' => $tutor])}}"/>
                            <form action="{{route('manager.tutor.destroy', ['tutor' => $tutor])}}" method="POST">
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
        $('#tableTeacher').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            pageLength: 12,
            lengthMenu: [12, 10, 5],
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

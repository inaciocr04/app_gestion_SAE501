<x-layout title="Tous les enseignants">
         <table id="tableTeacher">
             <thead>
             <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nom</th>
             <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Prénom</th>
             <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
             <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action</th>
             </thead>
             <tbody>
             @foreach($teachers as $teacher)
                 <tr>
                     <td> {{$teacher->lastname}}</td>
                     <td>{{ $teacher->firstname }}</td>
                     <td>{{ $teacher->unistra_email }}</td>
                     <td>
                         <form action="{{route('manager.teacher.destroy', ['teacher' => $teacher])}}" method="POST">
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

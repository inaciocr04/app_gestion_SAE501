<x-layout title="Tous les enseignants">
         <table id="tableTeacher">
             <thead>
             <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nom</th>
             <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Prénom</th>
             <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
             </thead>
             <tbody>
             @foreach($teachers as $teacher)
                 <tr>
                     <td> {{$teacher->lastname}}</td>
                     <td>{{ $teacher->firstname }}</td>
                     <td>{{ $teacher->unistra_email }}</td>
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
            pageLength: 15,
            lengthMenu: [15, 10, 5],
            language: {
                "sEmptyTable": "Aucune donnée disponible dans le tableau",
                "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ enseignants",
                "sInfoEmpty": "Affichage de 0 à 0 sur 0 entrées",
                "sInfoFiltered": "(filtré de _MAX_ entrées au total)",
                "sLengthMenu": "Afficher _MENU_ enseignants",
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

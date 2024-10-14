<x-layout title="Toutes les entreprises">
    <div class="mb-8">
        <a class="bg-fourth-color text-white py-3 px-4 rounded-2xl">Ajouter une entreprise</a>
    </div>
            <table id="tableCompany">
                <thead>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nom Entreprise</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Adresse Entreprise</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Code postal Entreprise</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Ville Entreprise</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Département Entreprise</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Pays Entreprise</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action</th>

                </thead>
                <tbody>
                @foreach($companies as $company)
                    <tr>
                        <td>{{$company->company_name}}</td>
                        <td>{{$company->company_address}}</td>
                        <td>{{$company->company_postcode}}</td>
                        <td>{{$company->company_city}}</td>
                        <td>{{$company->company_department}}</td>
                        <td>{{$company->company_country}}</td>
                        <td><a href="#">Détails</a> / <a href="#">Supprimer</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
</x-layout>

<script>
    $(document).ready(function () {
        $('#tableCompany').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            pageLength: 15,
            lengthMenu: [15, 10, 5],
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
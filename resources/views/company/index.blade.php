<x-layout title="Toutes les entreprises">
    <div class="mb-8">
        <x-link.link name="Ajouter une entreprise" href="{{route('manager.company.create')}}" class="mb-5"/>
        <x-link.link name="Liste des tuteurs" href="{{route('manager.tutor.index')}}" class="mb-5"/>
    </div>
            <table id="tableCompany">
                <thead>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nom </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Adresse</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Code postal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Ville</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Activitée</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Pays</th>
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
                        <td class="flex space-x-2">
                            <x-link.link name="Détails" href="{{route('manager.company.show', ['company' => $company])}}"/>
                            <form action="{{route('manager.company.destroy', ['company' => $company])}}" method="POST">
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
        $('#tableCompany').DataTable({
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

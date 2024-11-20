<x-layout title="Mes visites étudiants">
    <div x-data="{ showBut: 'but2' }" class="mt-6">
        <!-- Boutons de navigation -->
        <div class="flex flex-wrap sm:flex-row xs:space-y-4 lg:space-x-28 m-auto items-center justify-center w-fit px-6 sm:px-8 lg:px-24 py-4 bg-secondary-color rounded-2xl">
            @foreach (['but2' => 'BUT2', 'but3' => 'BUT3'] as $key => $label)
                <div
                    @click="showBut = '{{ $key }}'"
                    :class="{'bg-seventh-color text-black': showBut === '{{ $key }}', 'text-white': showBut !== '{{ $key }}'}"
                    class=" px-6 py-2 rounded-2xl cursor-pointer"
                >
                    <p>Étudiants {{ $label }}</p>
                </div>
            @endforeach
        </div>

        <!-- Contenu dynamique -->
        @foreach (['but2' => $studentsMMI2, 'but3' => $studentsMMI3] as $key => $students)
            <div x-show="showBut === '{{ $key }}'" class="mt-6" x-init="initializeDataTable('{{ $key }}')">
                <table id="table_{{ $key }}" class="display w-full">
                    <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nom et prénom</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Année de formation</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nom de l'entreprise</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Département</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Adresse</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Date de visite</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($students as $student)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $student->firstname }} {{ $student->lastname }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $student->last_visit->year_training->training_title ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $student->last_visit->company->company_name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $student->last_visit->company->company_department ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($student->last_visit->company?->company_address)
                                    {{ $student->last_visit->company->company_address }},
                                    {{ $student->last_visit->company->company_postcode }},
                                    {{ $student->last_visit->company->company_city }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if($student->last_visit->start_date_visit)
                                Du {{ \Carbon\Carbon::parse($student->last_visit->start_date_visit)->format('d M Y à H:i') }} au
                                {{ \Carbon\Carbon::parse($student->last_visit->end_date_visit)->format('d M Y à H:i') }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <x-link.link
                                    href="{{ route('visit.edit', $student->last_visit?->id ?? 0) }}"
                                    name="{{ $student->last_visit ? 'Modifier la visite' : 'Programmer la visite' }}"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>Aucun étudiant trouvé</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>N/A</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <script>
                // Initialisation de DataTable après le chargement de l'élément
                function initializeDataTable(key) {
                    // Utilisation d'Alpine.js pour vérifier que la table est visible avant l'initialisation
                    if (document.querySelector('#table_' + key)) {
                        new window.DataTable(document.querySelector('#table_' + key), {
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
                            ordering: true,
                            autoWidth: false,
                            pageLength: 8,
                            lengthMenu: [5, 8, 10, 15],
                            language: {
                                "sEmptyTable": "Aucune donnée disponible dans le tableau",
                                "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                                "sInfoEmpty": "Affichage de 0 à 0 sur 0 entrées",
                                "sInfoFiltered": "(filtré de _MAX_ entrées au total)",
                                "sLengthMenu": "Afficher _MENU_ entrées",
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
                    }
                }
            </script>
        @endforeach
    </div>
</x-layout>

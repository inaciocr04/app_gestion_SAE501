<x-layout title="Tous les utilisateurs">
    <div x-data="{ showRole: 'manager' }" class="mt-6">
        <!-- Navigation Tabs -->
        <div class="flex flex-wrap sm:flex-row xs:space-y-4 lg:space-x-28 m-auto items-center justify-center w-fit xs:px-6 sm:px-8 lg:px-24 py-4 bg-secondary-color rounded-2xl">
            @foreach (['manager' => 'Managers', 'teacher' => 'Enseignants', 'student' => 'Étudiants'] as $roleKey => $roleLabel)
                <div @click="showRole = '{{ $roleKey }}'"
                     :class="{'bg-seventh-color text-black': showRole === '{{ $roleKey }}', 'text-white': showRole !== '{{ $roleKey }}'}"
                     class="px-6 py-2 rounded-2xl cursor-pointer">
                    <p>{{ $roleLabel }}</p>
                </div>
            @endforeach
        </div>

        <!-- User Tables -->
        @foreach (['manager' => $managers, 'teacher' => $teachers, 'student' => $students] as $roleKey => $users)
            <div x-show="showRole === '{{ $roleKey }}'" class="mt-6">
                <table id="table_{{ $roleKey }}" class="display">
                    <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nom et Prénom</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('manager.user.update', $user) }}" method="POST" class="flex space-x-4">
                                    @csrf
                                    @method('PATCH')
                                    <select name="role" class="form-select">
                                        @foreach(['manager' => 'Manager', 'teacher' => 'Enseignants', 'student' => 'Étudiants'] as $role => $roleLabel)
                                            <option value="{{ $role }}" {{ $user->role === $role ? 'selected' : '' }}>
                                                {{ $roleLabel }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-form.button name="Modifier" />
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    $('#table_{{ $roleKey }}').DataTable({
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
                        pageLength: 10,
                        lengthMenu: [5, 10, 15],
                        language: {
                            sEmptyTable: "Aucune donnée disponible dans le tableau",
                            sInfo: "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                            sInfoEmpty: "Affichage de 0 à 0 sur 0 entrées",
                            sInfoFiltered: "(filtré de _MAX_ entrées au total)",
                            sLengthMenu: "Afficher _MENU_ entrées",
                            sLoadingRecords: "Chargement...",
                            sProcessing: "Traitement...",
                            sSearch: "Recherche:",
                            sZeroRecords: "Aucun résultat trouvé",
                            oPaginate: {
                                sFirst: "Premier",
                                sLast: "Dernier",
                                sNext: "Suivant",
                                sPrevious: "Précédent"
                            },
                            oAria: {
                                sSortAscending: ": activer pour trier la colonne par ordre croissant",
                                sSortDescending: ": activer pour trier la colonne par ordre décroissant"
                            }
                        },
                    });
                });
            </script>
        @endforeach
    </div>
</x-layout>

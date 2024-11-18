<x-layout title="Tous les utilisateurs">
<div x-data="{ showUser : 'manager' }" class="mt-6">
    <div class="flex space-x-28 m-auto items-center  justify-center w-fit px-24 py-4 bg-secondary-color rounded-2xl">
        <div @click="showUser = 'manager'" :class="{'bg-seventh-color text-black': showUser === 'manager', 'text-white': showUser !== 'manager'}"
             class="px-6 py-2 rounded-2xl cursor-pointer">
            <p>Managers</p>
        </div>
        <div @click="showUser = 'teacher'" :class="{'bg-seventh-color text-black': showUser === 'teacher', 'text-white': showUser !== 'teacher'}"
             class="px-6 py-2 rounded-3xl cursor-pointer">
            <p>Enseignants</p>
        </div>
        <div @click="showUser = 'student'" :class="{'bg-seventh-color text-black': showUser === 'student', 'text-white': showUser !== 'student'}"
             class="px-6 py-2 rounded-3xl cursor-pointer">
            <p>Etudiants</p>
        </div>
    </div>
    <div x-show="showUser === 'manager'">
        <table id="tableManager">
            <thead>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nom et Prénom</th>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action</th>
            </thead>
            <tbody>
            @foreach($managers as $manager)
                <tr class="bg-sixth-color px-8 py-6">
                    <td>{{ $manager->name }}</td>
                    <td>{{ $manager->email }}</td>
                    <td>
                        <form action="{{ route('user.update', $manager) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')

                            <select name="role" class="ml-4">
                                <option value="student" {{ $manager->role === 'student' ? 'selected' : '' }}>Étudiants</option>
                                <option value="teacher" {{ $manager->role === 'teacher' ? 'selected' : '' }}>Enseignants</option>
                                <option value="manager" {{ $manager->role === 'manager' ? 'selected' : '' }}>Manager</option>
                            </select>
                            <x-form.button name="Modifier le rôle"/>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div x-show="showUser === 'teacher'">
        <table id="tableTeacher">
            <thead>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nom et Prénom</th>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action</th>
            </thead>
            <tbody>
            @foreach($teachers as $teacher)
                <tr class="bg-sixth-color px-8 py-6">
                    <td>{{ $teacher->name }}</td>
                    <td>{{ $teacher->email }}</td>
                    <td>
                        <form action="{{ route('user.update', $teacher) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')

                            <select name="role" class="ml-4">
                                <option value="student" {{ $teacher->role === 'student' ? 'selected' : '' }}>Étudiants</option>
                                <option value="teacher" {{ $teacher->role === 'teacher' ? 'selected' : '' }}>Enseignants</option>
                                <option value="manager" {{ $teacher->role === 'manager' ? 'selected' : '' }}>Manager</option>
                            </select>
                            <x-form.button name="Modifier le rôle"/>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div x-show="showUser === 'student'">
        <table id="tableStudent">
            <thead>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nom et Prénom</th>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action</th>
            </thead>
            <tbody>
            @foreach($students as $student)
                <tr class="bg-sixth-color px-8 py-6">
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>
                        <form action="{{ route('user.update', $student) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')

                            <select name="role" class="ml-4">
                                <option value="student" {{ $student->role === 'student' ? 'selected' : '' }}>Étudiants</option>
                                <option value="teacher" {{ $student->role === 'teacher' ? 'selected' : '' }}>Enseignants</option>
                                <option value="manager" {{ $student->role === 'manager' ? 'selected' : '' }}>Manager</option>
                            </select>
                            <x-form.button name="Modifier le rôle"/>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</x-layout>

<script>
    $(document).ready(function () {
        $('#tableManager').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            pageLength: 15,
            lengthMenu: [15, 10, 5],
            language: {
                "sEmptyTable": "Aucune donnée disponible dans le tableau",
                "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ managers",
                "sInfoEmpty": "Affichage de 0 à 0 sur 0 entrées",
                "sInfoFiltered": "(filtré de _MAX_ entrées au total)",
                "sLengthMenu": "Afficher _MENU_ managers",
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
        $('#tableStudent').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            pageLength: 15,
            lengthMenu: [15, 10, 5],
            language: {
                "sEmptyTable": "Aucune donnée disponible dans le tableau",
                "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ étudiants",
                "sInfoEmpty": "Affichage de 0 à 0 sur 0 entrées",
                "sInfoFiltered": "(filtré de _MAX_ entrées au total)",
                "sLengthMenu": "Afficher _MENU_ étudiants",
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

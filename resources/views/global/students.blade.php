<x-layout title="Tous les étudiants">
    <x-link.link name="Créer un étudiant" href="{{route('student.create')}}"/>
    <div x-data="{ showBut : 'but1' }" class="mt-6">
        <div class="flex space-x-28 m-auto items-center  justify-center w-fit px-24 py-4 bg-secondary-color rounded-2xl">
            <div @click="showBut = 'but1'" :class="{'bg-seventh-color text-black': showBut === 'but1', 'text-white': showBut !== 'but1'}"
                 class="px-6 py-2 rounded-2xl cursor-pointer">
                <p>Etudiant BUT1</p>
            </div>
            <div @click="showBut = 'but2'" :class="{'bg-seventh-color text-black': showBut === 'but2', 'text-white': showBut !== 'but2'}"
                 class="px-6 py-2 rounded-3xl cursor-pointer">
                <p>Etudiant BUT2</p>
            </div>
            <div @click="showBut = 'but3'" :class="{'bg-seventh-color text-black': showBut === 'but3', 'text-white': showBut !== 'but3'}"
                 class="px-6 py-2 rounded-3xl cursor-pointer">
                <p>Etudiant BUT3</p>
            </div>
        </div>
        <div x-show="showBut === 'but1'" class="mt-16">
            <table id="tableBut1" class="display">
                <thead>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">N°étudiant</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Prénom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Formation Actuelle</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Parcours</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Groupes</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Date de début</th>
                    @canany(['updateAny', 'deleteAny'], \App\Models\Student::class)
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action</th>
                    @endcanany
                </thead>
                <tbody>
                @foreach($studentsMMI1 as $student)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{$student->student_number}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{$student->firstname}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{$student->lastname}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{$student->trainings->last()->year_training->training_title}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($student->courses->isNotEmpty() && $student->courses->last()->training_course)
                                {{$student->courses->last()->training_course->course_title}}
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($student->courses->isNotEmpty() && $student->courses->last()->group_td && $student->courses->last()->group_tp)
                                {{$student->courses->last()->group_td->td_name}} / {{$student->courses->last()->group_tp->tp_name}}
                            @else
                                N/A
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($student->courses->isNotEmpty())
                                {{$student->courses->last()->start_date}}
                            @else
                                N/A
                            @endif
                        </td>
                        @canany(['update', 'delete'], $student)
                            <td>
                                @can('update', $student)
                                    <a href="{{route('student.edit', ['student' => $student])}}">update</a>
                                @endcan
                                @can('delete', $student)
                                    Delete
                                @endcan
                            </td>
                        @endcanany
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div x-show="showBut === 'but2'" class="mt-16">
            <table id="tableBut2" class="display">
                <thead>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">N°étudiant</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nom</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Prénom</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Formation Actuelle</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Parcours</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Groupes</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Date de début</th>
                @canany(['updateAny', 'deleteAny'], \App\Models\Student::class)
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action</th>
                @endcanany
                </thead>
                <tbody>
                @foreach($studentsMMI2 as $student)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{$student->student_number}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{$student->firstname}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{$student->lastname}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{$student->trainings->last()->year_training->training_title}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($student->courses->isNotEmpty() && $student->courses->last()->training_course)
                                {{$student->courses->last()->training_course->course_title}}
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($student->courses->isNotEmpty() && $student->courses->last()->group_td && $student->courses->last()->group_tp)
                                {{$student->courses->last()->group_td->td_name}} / {{$student->courses->last()->group_tp->tp_name}}
                            @else
                                N/A
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($student->courses->isNotEmpty())
                                {{$student->courses->last()->start_date}}
                            @else
                                N/A
                            @endif
                        </td>
                        @canany(['update', 'delete'], $student)
                            <td>
                                @can('update', $student)
                                    <a href="{{route('student.edit', ['student' => $student])}}">update</a>
                                @endcan
                                @can('delete', $student)
                                    Delete
                                @endcan
                            </td>
                        @endcanany
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div x-show="showBut === 'but3'" class="mt-16">
            <table id="tableBut3" class="display">
                <thead>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">N°étudiant</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nom</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Prénom</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Formation Actuelle</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Parcours</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Groupes</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Date de début</th>
                @canany(['updateAny', 'deleteAny'], \App\Models\Student::class)
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action</th>
                @endcanany
                </thead>
                <tbody>
                @foreach($studentsMMI3 as $student)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{$student->student_number}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{$student->firstname}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{$student->lastname}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{$student->trainings->last()->year_training->training_title}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($student->courses->isNotEmpty() && $student->courses->last()->training_course)
                                {{$student->courses->last()->training_course->course_title}}
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($student->courses->isNotEmpty() && $student->courses->last()->group_td && $student->courses->last()->group_tp)
                                {{$student->courses->last()->group_td->td_name}} / {{$student->courses->last()->group_tp->tp_name}}
                            @else
                                N/A
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($student->courses->isNotEmpty())
                                {{$student->courses->last()->start_date}}
                            @else
                                N/A
                            @endif
                        </td>
                        @canany(['update', 'delete'], $student)
                            <td>
                                @can('update', $student)
                                Update
                                @endcan
                                @can('delete', $student)
                                    Delete
                                    @endcan
                            </td>
                        @endcanany
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>

<script>
    $(document).ready(function () {
        $('#tableBut1').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            pageLength: 15,
            lengthMenu: [15, 10, 5],
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
        $('#tableBut2').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            pageLength: 15,
            lengthMenu: [15, 10, 5],
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
        $('#tableBut3').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            pageLength: 15,
            lengthMenu: [15, 10, 5],
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
    });
</script>

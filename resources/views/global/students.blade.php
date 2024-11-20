<x-layout title="Tous les étudiants">
    @canany(['create'], \App\Models\Student::class)
        <x-link.link name="Créer un étudiant" href="{{route('manager.student.create')}}"/>
    @endcanany
    <div x-data="{ showBut : 'but1' }" class="mt-6">
        <div class="flex flex-wrap sm:flex-row xs:space-y-4 lg:space-x-28 m-auto items-center justify-center w-fit xs:px-6 sm:px-8 lg:px-24 py-4 bg-secondary-color rounded-2xl">
            @foreach (['but1' => 'BUT1', 'but2' => 'BUT2', 'but3' => 'BUT3'] as $but => $but_label)
            <div @click="showBut = '{{ $but }}'" :class="{'bg-seventh-color text-black': showBut === '{{ $but }}', 'text-white': showBut !== '{{ $but }}'}"
                    class="px-6 py-2 rounded-2xl cursor-pointer">
                <p>Etudiant {{ $but_label }}</p>
            </div>
            @endforeach
        </div>
        @foreach (['but1' => 'MMI1', 'but2' => 'MMI2', 'but3' => 'MMI3'] as $but => $students_key)
        <div x-show="showBut === '{{ $but }}'" class="mt-6">
            <table id="table_{{ $but }}" class="display">
                <thead>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">N°étudiant</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Prénom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Formation Actuelle</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Parcours</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Groupes</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Date de début</th>
                    @canany(['viewTutor'], \App\Models\Student::class)
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">tuteur enseignant</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Visits</th>
                    @endcanany
                    @canany(['updateAny', 'deleteAny'], \App\Models\Student::class)
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action</th>
                    @endcanany
                </thead>
                <tbody>
                @foreach($students[$students_key] ?? [] as $student)
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
                        @canany(['viewTutor'], \App\Models\Student::class)
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($student->student_statu->isNotEmpty())
                                    {{$student->student_statu->last()->teacher ? $student->student_statu->last()->teacher->firstname .' '. $student->student_statu->last()->teacher->lastname : 'N/A'}}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if($student->visits->last()->start_date_visit >= now())
                                    Visite prévu le
                                    ({{$student->visits->last()->start_date_visit ? $student->visits->last()->start_date_visit : 'N/A'}})
                                @else
                                    Visite déjà éffectuer
                                @endif
                            </td>
                        @endcanany
                        @canany(['update', 'delete'], $student)
                            <td>
                                @can('update', $student)
                                    <x-link.link name="Modifier" href="{{route('manager.student.edit', ['student' => $student])}}"/>
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
            <script>
            window.addEventListener('load',
            function () {
                $('#table_{{ $but }}').DataTable({
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
                    lengthMenu: [5,8,10, 15],
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
                    },
                });
            });
        </script>
        @endforeach
    </div>
</x-layout>

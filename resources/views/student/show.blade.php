@php
    use Carbon\Carbon;
    Carbon::setLocale('fr');
@endphp

<x-layout title="Mes Informations">

    <div x-data="{ showBut: {{ array_key_exists('MMI3', $dataByTraining) ? "'but3'" : "'but2'" }} }">
        <div class="flex justify-center lg:px-60 space-x-6 items-center">
            <div class="hidden lg:!block">
                <img class="w-72" src="/img/user_photo.png" alt="">
            </div>

            @foreach (['MMI2' => 'but2', 'MMI3' => 'but3'] as $trainingTitle => $buttonKey)
                @if (array_key_exists($trainingTitle, $dataByTraining))
                    <div x-show="showBut === '{{ $buttonKey }}'" class="flex flex-col space-y-2 w-full">
                        <div class="block lg:flex p-2 lg:justify-between">
                            <p class="font-custom font-regular">
                                <span class="font-poppins font-semibold">N° étudiant :</span> {{ $student->student_number }}
                            </p>
                            <p>
                                <span class="font-poppins font-semibold">Parcours:</span>
                                {{ $dataByTraining[$trainingTitle]['training']->year_training->training_title }}
                            </p>
                            @foreach ($dataByTraining[$trainingTitle]['courses'] as $course)
                                <p>
                                    <span class="font-poppins font-semibold">Statut:</span> {{ $course->training_course->course_title }} en
                                    @foreach ($dataByTraining[$trainingTitle]['status'] as $studentStatu)
                                        {{ $studentStatu->statu ? $studentStatu->statu->statut_title : 'Statut non défini' }}
                                    @endforeach
                                </p>
                            @endforeach
                        </div>

                        <div class="block lg:flex p-2 lg:justify-between">
                            <p>
                                <span class="font-poppins font-semibold">Nom:</span> {{ $student->lastname }}
                            </p>
                            <p>
                                <span class="font-poppins font-semibold">Prénom:</span> {{ $student->firstname }}
                            </p>
                            @foreach ($dataByTraining[$trainingTitle]['courses'] as $course)
                                <p>
                                    <span class="font-poppins font-semibold">Groupes:</span>
                                    {{ $course->group_tp->tp_name }} / {{ $course->group_td->td_name }}
                                </p>
                            @endforeach
                        </div>

                        <div class="block lg:flex p-2 lg:justify-between">
                            <p>
                                <span class="font-poppins font-semibold">Date de naissance:</span> {{ Carbon::parse($student->date_birth)->format('d-m-Y') }}
                            </p>
                            <p>
                                <span class="font-poppins font-semibold">N° de téléphone:</span> {{ $student->telephone_number }}
                            </p>
                        </div>

                        <div class="p-2 space-y-4">
                            <p>
                                <span class="font-poppins font-semibold">Adresse:</span> {{ $student->address }}, {{ $student->city }}, {{ $student->postcode }}
                            </p>
                            <p>
                                <span class="font-poppins font-semibold">Email personnel:</span> {{ $student->personal_email }}
                            </p>
                            <p>
                                <span class="font-poppins font-semibold">Email unistra:</span> {{ $student->unistra_email }}
                            </p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="bg-secondary-color mt-8 lg:mx-60 py-3 px-3 lg:px-8 rounded-2xl h-16 w-auto lg:!w-96 flex justify-between">
            @if (array_key_exists('MMI2', $dataByTraining))
                <div @click="showBut = 'but2'" :class="{'bg-seventh-color text-black': showBut === 'but2', 'text-white': showBut !== 'but2'}"
                     class="px-6 py-2 rounded-2xl cursor-pointer">
                    <p>Parcours BUT2</p>
                </div>
            @endif
            @if (array_key_exists('MMI3', $dataByTraining))
                    <div @click="showBut = 'but3'" :class="{'bg-seventh-color text-black': showBut === 'but3', 'text-white': showBut !== 'but3'}"
                         class="px-6 py-2 rounded-2xl cursor-pointer">
                        <p>Parcours BUT 3</p>
                    </div>
            @endif
        </div>

        <!-- Information sur le tuteur et l'entreprise -->
        <div class="space-y-8">
            <h4 class="font-bold text-lg mt-4 mb-4 text-center">Tuteur et Entreprise</h4>

        @foreach (['MMI2' => 'but2', 'MMI3' => 'but3'] as $trainingTitle => $buttonKey)
                @if (array_key_exists($trainingTitle, $dataByTraining))
                    <div x-show="showBut === '{{ $buttonKey }}'" class="space-y-8">
                        <p>
                            <span class="font-poppins font-semibold">Tuteur enseignant:</span>
                            @foreach ($dataByTraining[$trainingTitle]['status'] as $studentStatu)
                                {{ $studentStatu->teacher->firstname }} {{ $studentStatu->teacher->lastname }} contacté à "{{ $studentStatu->teacher->unistra_email }}",
                                @foreach ($dataByTraining[$trainingTitle]['visits'] as $visit)
                                    @if ($visit->visit_statu === 'OUI')
                                        @if ($visit->start_date_visit >= now())
                                            une visite est à effectuer le {{ Carbon::parse($visit->start_date_visit)->isoFormat('DD MMMM YYYY') }} au {{ Carbon::parse($visit->end_date_visit)->isoFormat('DD MMMM YYYY') }}
                                        @else
                                            une visite a été effectuée le {{ Carbon::parse($visit->start_date_visit)->isoFormat('DD MMMM YYYY') }} au {{ Carbon::parse($visit->end_date_visit)->isoFormat('DD MMMM YYYY') }}
                                        @endif
                                    @elseif ($visit->visit_statu === 'NON')
                                        aucune date n'est prévue
                                    @endif
                                @endforeach
                            @endforeach
                        </p>

                        <div class="flex flex-wrap space-y-7 lg:flex-row lg:space-y-0 w-full justify-evenly">
                            <!-- Tuteur -->
                            <div class="bg-sixth-color rounded-2xl p-6">
                                <h4 class="text-center font-poppins font-semibold text-base">Tuteur</h4>
                                @if ($dataByTraining[$trainingTitle]['status']->isEmpty())
                                    <p>Aucun tuteur enregistré pour {{ $trainingTitle }}.</p>
                                @else
                                    <ul>
                                        @foreach ($dataByTraining[$trainingTitle]['status'] as $studentStatu)
                                            @if ($studentStatu->tutor)
                                                <li><span class="font-poppins font-semibold">Civilité:</span> {{ $studentStatu->tutor->civility }}</li>
                                                <li><span class="font-poppins font-semibold">Nom:</span> {{ $studentStatu->tutor->lastname }}</li>
                                                <li><span class="font-poppins font-semibold">Prénom:</span> {{ $studentStatu->tutor->firstname }}</li>
                                                <li><span class="font-poppins font-semibold">Email:</span> {{ $studentStatu->tutor->email }}</li>
                                                <li><span class="font-poppins font-semibold">N° téléphone:</span> {{ $studentStatu->tutor->telephone_number }}</li>
                                            @else
                                                <p>Aucun tuteur attribué.</p>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                            <!-- Manager -->
                            <div class="bg-sixth-color rounded-2xl p-6">
                                <h4 class="text-center font-poppins font-semibold text-base">Manager</h4>
                                @if ($dataByTraining[$trainingTitle]['status']->isEmpty())
                                    <p>Aucun manager enregistrée pour {{ $trainingTitle }}.</p>
                                @else
                                    <ul>
                                        @foreach ($dataByTraining[$trainingTitle]['status'] as $studentStatu)
                                            @if ($studentStatu->company)
                                                <li><span class="font-poppins font-semibold">Civilité:</span> {{ $studentStatu->company->company_manager_civility }}</li>
                                                <li><span class="font-poppins font-semibold">Nom:</span> {{ $studentStatu->company->company_manager_lastname }}</li>
                                                <li><span class="font-poppins font-semibold">Prénom:</span> {{ $studentStatu->company->company_manager_firstname }}</li>
                                                <li><span class="font-poppins font-semibold">Email:</span> {{ $studentStatu->company->company_manager_email }}</li>
                                                <li><span class="font-poppins font-semibold">N° téléphone:</span> {{ $studentStatu->company->company_manager_tel_number }}</li>
                                            @else
                                                <p>Aucun manager attribuée.</p>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                            <!-- Entreprise -->
                            <div class="bg-sixth-color rounded-2xl p-6">
                                <h4 class="text-center font-poppins font-semibold text-base">Entreprise</h4>
                                @if ($dataByTraining[$trainingTitle]['status']->isEmpty())
                                    <p>Aucune entreprise enregistrée pour {{ $trainingTitle }}.</p>
                                @else
                                    <ul>
                                        @foreach ($dataByTraining[$trainingTitle]['status'] as $studentStatu)
                                            @if ($studentStatu->company)
                                                <li><span class="font-poppins font-semibold">Nom:</span> {{ $studentStatu->company->company_name }}</li>
                                                <li><span class="font-poppins font-semibold">Activité:</span> {{ $studentStatu->company->company_department }}</li>
                                                <li><span class="font-poppins font-semibold">Adresse:</span> {{ $studentStatu->company->company_address }}</li>
                                                <li><span class="font-poppins font-semibold">Code postal:</span> {{ $studentStatu->company->company_postcode }}</li>
                                                <li><span class="font-poppins font-semibold">Ville:</span> {{ $studentStatu->company->company_city }}</li>
                                                <li><span class="font-poppins font-semibold">Pays:</span> {{ $studentStatu->company->company_country }}</li>
                                            @else
                                                <p>Aucune entreprise attribué.</p>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-layout>

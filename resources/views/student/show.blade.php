@php
    use Carbon\Carbon;
    Carbon::setLocale('fr');
@endphp
<x-layout title="Mes Informations">

    <div x-data="{ showBut: {{ $mmi3 ? "'but3'" : "'but2'" }} }">
            <div class="flex justify-center px-60 space-x-6 items-center">
                <div>
                    <img class="w-72" src="/img/user_photo.png" alt="">
                </div>
                <div x-show="showBut === 'but2'" class=" flex flex-col space-y-2 w-full">
                    <div class="flex p-2 justify-between">
                        <p class="font-custom font-regular"><span class="font-poppins font-semibold">N° étudiant :</span> {{$student->student_number}}</p>
                        <p><span class="font-poppins font-semibold">Parcours: </span>{{$mmi2 ? $mmi2->year_training->training_title : 'Parcours non défini'}}</p>
                        @foreach($coursesMMI2 as $course)
                            <p><span class="font-poppins font-semibold">Status: </span>{{ $course->training_course->course_title }}  en
                                @foreach ($statusMMI2 as $studentStatu)
                                    {{ $studentStatu->statu ? $studentStatu->statu->statut_title : 'Statut non défini' }}
                                @endforeach</p>
                        @endforeach
                    </div>
                    <div class="flex p-2 space-x-20">
                        <p><span class="font-poppins font-semibold">Nom: </span> {{$student->lastname}}</p>
                        <p><span class="font-poppins font-semibold">Prénom: </span> {{$student->firstname}}</p>
                        @foreach($coursesMMI2 as $course)
                            <p><span class="font-poppins font-semibold">Groupes: </span>{{ $course->group_tp->tp_name }} / {{ $course->group_td->td_name }}</p>
                        @endforeach
                    </div>
                    <div class="flex p-2 space-x-10">
                        <p><span class="font-poppins font-semibold">Date de naissance: </span>{{Carbon::parse($student->date_birth)->format('d-m-Y')}}</p>
                        <p><span class="font-poppins font-semibold">N° de téléphone: </span>{{$student->telephone_number}}</p>
                    </div>
                    <div class="p-2 space-y-4">
                        <p><span class="font-poppins font-semibold">Adresse: </span>{{$student->address}}, {{$student->city}}, {{$student->postcode}}</p>
                        <p><span class="font-poppins font-semibold">Email personnel:</span> {{$student->personal_email}}</p>
                        <p><span class="font-poppins font-semibold">Email unistra: </span>{{$student->unistra_email}}</p>
                    </div>

                </div>
                <div x-show="showBut === 'but3'" class=" flex flex-col space-y-2 w-full">
                    <div class="flex p-2 justify-between">
                        <p class="font-custom font-regular"><span class="font-poppins font-semibold">N° étudiant :</span> {{$student->student_number}}</p>
                        <p><span class="font-poppins font-semibold">Parcours: </span>{{$mmi3 ? $mmi3->year_training->training_title : 'Parcours non défini'}}</p>
                        @foreach($coursesMMI3 as $course)
                            <p><span class="font-poppins font-semibold">Status: </span>{{ $course->training_course->course_title }}  en
                                @foreach ($statusMMI3 as $studentStatu)
                                    {{ $studentStatu->statu ? $studentStatu->statu->statut_title : 'Statut non défini' }}
                                @endforeach
                            </p>
                        @endforeach
                    </div>
                    <div class="flex p-2 space-x-10">
                        <p><span class="font-poppins font-semibold">Nom: </span> {{$student->lastname}}</p>
                        <p><span class="font-poppins font-semibold">Prénom: </span> {{$student->firstname}}</p>
                        @foreach($coursesMMI3 as $course)
                            <p><span class="font-poppins font-semibold">Groupes: </span>{{ $course->group_tp->tp_name }} / {{ $course->group_td->td_name }}</p>
                        @endforeach
                    </div>
                    <div class="flex p-2 space-x-10">
                        <p><span class="font-poppins font-semibold">Date de naissance: </span>{{Carbon::parse($student->date_birth)->format('d-m-Y')}}</p>
                        <p><span class="font-poppins font-semibold">N° de téléphone: </span>{{$student->telephone_number}}</p>
                    </div>
                    <div class="p-2 space-y-4">
                        <p><span class="font-poppins font-semibold">Adresse: </span>{{$student->address}}, {{$student->city}}, {{$student->postcode}}</p>
                        <p><span class="font-poppins font-semibold">Email personnel:</span> {{$student->personal_email}}</p>
                        <p><span class="font-poppins font-semibold">Email unistra: </span>{{$student->unistra_email}}</p>
                    </div>

                </div>
            </div>

            <div class="bg-secondary-color mt-8 mx-60 py-3 px-8 rounded-2xl h-16 w-96 flex justify-between ">
                <button
                    @click="showBut = 'but2'"
                    :class="{'bg-seventh-color text-white': showBut === 'but2', 'text-white': showBut !== 'but2'}"
                    class="px-4 py-2 rounded-xl font-bold"
                >
                    Parcours BUT 2
                </button>
                <button
                    @click="showBut = 'but3'"
                    :class="{'bg-seventh-color text-white': showBut === 'but3', ' text-white': showBut !== 'but3'}"
                    class="px-4 py-2 rounded-xl font-bold"
                >
                    Parcours BUT 3
                </button>
            </div>
            <!-- BUT2 Information Section -->
            <div x-show="showBut === 'but2'" class="space-y-8">
                <p class="mt-8"><span class="font-poppins font-semibold">Tuteur enseignant:</span>
                    @foreach ($statusMMI2 as $studentStatu)
                        {{$studentStatu->teacher->firstname}}
                        {{$studentStatu->teacher->lastname}}
                        à contacté à " {{$studentStatu->teacher->unistra_email}} ",
                        @foreach($visitsMMI2 as $visit)
                            @if($visit->visit_statu === 'OUI')
                                @if($visit->start_date_visit >= now())
                                    une visite est a effectué le {{ Carbon::parse($visit->start_date_visit)->isoFormat('DD MMMM YYYY') }} au {{ Carbon::parse($visit->end_date_visit)->isoFormat('DD MMMM YYYY') }}
                                @else
                                    une visite à été effectué le {{ Carbon::parse($visit->start_date_visit)->isoFormat('DD MMMM YYYY') }} au {{ Carbon::parse($visit->end_date_visit)->isoFormat('DD MMMM YYYY') }}
                                @endif
                            @elseif($visit->visit_statu === 'NON')
                                aucune date n'est prévu
                            @endif
                        @endforeach
                    @endforeach
                </p>
                @if($mmi2)
                <div class="flex w-full justify-evenly">
                    <div class="bg-sixth-color rounded-2xl p-6">
                        <h4 class="text-center font-poppins font-semibold text-base">Tuteur</h4>
                        @if ($statusMMI2->isEmpty())
                            <p>Aucune visite enregistrée pour MMI2.</p>
                        @else
                            <ul>
                                @foreach ($statusMMI2 as $studentStatu)
                                    @if($studentStatu->tutor)
                                        <li><span class="font-poppins font-semibold">Civilité:</span> {{ $studentStatu->tutor->civility }}</li>
                                        <li><span class="font-poppins font-semibold">Nom:</span> {{ $studentStatu->tutor->lastname }}</li>
                                        <li><span class="font-poppins font-semibold">Prénom:</span> {{ $studentStatu->tutor->firstname }}</li>
                                        <li><span class="font-poppins font-semibold">Email:</span> {{ $studentStatu->tutor->email }}</li>
                                        <li><span class="font-poppins font-semibold">N° téléphone:</span> {{ $studentStatu->tutor->telephone_number }}</li>
                                    @else
                                        <p>Aucun tuteur enregistrée pour MMI2.</p>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <div class="bg-sixth-color rounded-2xl p-6">
                        <h4 class="text-center font-poppins font-semibold text-base">Responsable</h4>
                        @if ($visitsMMI2->isEmpty())
                            <p>Aucune visite enregistrée pour MMI2.</p>
                        @else
                            <ul>
                                @foreach ($visitsMMI2 as $visit)
                                    @if($visit && $visit->company)
                                        <li><span class="font-poppins font-semibold">Civilité:</span> {{$visit->company->company_manager_civility}}</li>
                                        <li><span class="font-poppins font-semibold">Nom:</span> {{$visit->company->company_manager_lastname}}</li>
                                        <li><span class="font-poppins font-semibold">Prénom:</span> {{$visit->company->company_manager_firstname}}</li>
                                        <li><span class="font-poppins font-semibold">Email:</span> {{$visit->company->company_manager_email}}</li>
                                        <li><span class="font-poppins font-semibold">N°téléphone:</span> {{$visit->company->company_manager_tel_number}}</li>
                                    @else
                                        <p>Aucune manager enregistrée pour MMI2.</p>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <div class="bg-sixth-color rounded-2xl p-6">
                        <h4 class="text-center font-poppins font-semibold text-base">Entreprise</h4>
                        @if ($visitsMMI2->isEmpty())
                            <p>Aucune visite enregistrée pour MMI2.</p>
                        @else
                            <ul>
                                @foreach ($visitsMMI2 as $visit)
                                    @if($visit && $visit->company)
                                        <li><span class="font-poppins font-semibold">Nom de l'entreprise:</span> {{$visit->company->company_name}}</li>
                                        <li><span class="font-poppins font-semibold">Adresse:</span> {{$visit->company->company_address}}, {{$visit->company->company_city}}, {{$visit->company->company_postcode}} </li>
                                        <li><span class="font-poppins font-semibold">Département:</span> {{$visit->company->company_departement}}</li>
                                        <li><span class="font-poppins font-semibold">Pays:</span> {{$visit->company->company_country}}</li>
                                    @else
                                        <p>Aucune d'entreprise enregistrée pour MMI2.</p>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                    <div class=" space-y-6">
                        <h4 class="text-center font-poppins font-semibold text-base">Remarque</h4>

                        @foreach ($visitsMMI2 as $visit)
                            @if($visit->note = null)
                                <p>Aucune remarque n'a été renseigné</p>
                            @else
                                <p>{{$visit->note}}</p>
                            @endif
                        @endforeach

                    </div>
                @endif
            </div>

        <!-- BUT3 Information Section -->
        <div x-show="showBut === 'but3'" class="space-y-8">
            <p class="mt-8"><span class="font-poppins font-semibold">Tuteur enseignant:</span>
                @foreach ($statusMMI3 as $studentStatu)
                    {{$studentStatu->teacher->firstname}}
                    {{$studentStatu->teacher->lastname}}
                    à contacté à " {{$studentStatu->teacher->unistra_email}} ",
                    @foreach($visitsMMI3 as $visit)
                        @if($visit->visit_statu === 'OUI')
                            @if($visit->start_date_visit >= now())
                                une visite est a effectué le {{ Carbon::parse($visit->start_date_visit)->isoFormat('DD MMMM YYYY') }} au {{ Carbon::parse($visit->end_date_visit)->isoFormat('DD MMMM YYYY') }}
                            @else
                                une visite à été effectué le {{ Carbon::parse($visit->start_date_visit)->isoFormat('DD MMMM YYYY') }} au {{ Carbon::parse($visit->end_date_visit)->isoFormat('DD MMMM YYYY') }}
                            @endif
                        @elseif($visit->visit_statu === 'NON')
                            aucune date n'est prévu
                        @endif
                    @endforeach
                @endforeach
            </p>
            @if($mmi3)
                <div class="flex w-full justify-evenly">
                    <div class="bg-sixth-color rounded-2xl p-6">
                        <h4 class="text-center font-poppins font-semibold text-base">Tuteur</h4>
                        @if ($statusMMI3->isEmpty())
                            <p>Aucune visite enregistrée pour MMI3.</p>
                        @else
                            <ul>
                                @foreach ($statusMMI3 as $studentStatu)
                                    @if($studentStatu->tutor)
                                        <li><span class="font-poppins font-semibold">Civilité:</span> {{ $studentStatu->tutor->civility }}</li>
                                        <li><span class="font-poppins font-semibold">Nom:</span> {{ $studentStatu->tutor->lastname }}</li>
                                        <li><span class="font-poppins font-semibold">Prénom:</span> {{ $studentStatu->tutor->firstname }}</li>
                                        <li><span class="font-poppins font-semibold">Email:</span> {{ $studentStatu->tutor->email }}</li>
                                        <li><span class="font-poppins font-semibold">N° téléphone:</span> {{ $studentStatu->tutor->telephone_number }}</li>
                                    @else
                                        <p>Aucun tuteur enregistrée pour MMI3.</p>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <div class="bg-sixth-color rounded-2xl p-6">
                        <h4 class="text-center font-poppins font-semibold text-base">Responsable</h4>
                        @if ($visitsMMI3->isEmpty())
                            <p>Aucune visite enregistrée pour MMI3.</p>
                        @else
                            <ul>
                                @foreach ($visitsMMI3 as $visit)
                                    @if($visit && $visit->company)
                                        <li><span class="font-poppins font-semibold">Civilité:</span> {{$visit->company->company_manager_civility}}</li>
                                        <li><span class="font-poppins font-semibold">Nom:</span> {{$visit->company->company_manager_lastname}}</li>
                                        <li><span class="font-poppins font-semibold">Prénom:</span> {{$visit->company->company_manager_firstname}}</li>
                                        <li><span class="font-poppins font-semibold">Email:</span> {{$visit->company->company_manager_email}}</li>
                                        <li><span class="font-poppins font-semibold">N°téléphone:</span> {{$visit->company->company_manager_tel_number}}</li>
                                    @else
                                        <p>Aucune manager enregistrée pour MMI3.</p>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <div class="bg-sixth-color rounded-2xl p-6">
                        <h4 class="text-center font-poppins font-semibold text-base">Entreprise</h4>
                        @if ($visitsMMI3->isEmpty())
                            <p>Aucune visite enregistrée pour MMI3.</p>
                        @else
                            <ul>
                                @foreach ($visitsMMI3 as $visit)
                                    @if($visit && $visit->company)
                                        <li><span class="font-poppins font-semibold">Nom de l'entreprise:</span> {{$visit->company->company_name}}</li>
                                        <li><span class="font-poppins font-semibold">Adresse:</span> {{$visit->company->company_address}}, {{$visit->company->company_city}}, {{$visit->company->company_postcode}} </li>
                                        <li><span class="font-poppins font-semibold">Département:</span> {{$visit->company->company_departement}}</li>
                                        <li><span class="font-poppins font-semibold">Pays:</span> {{$visit->company->company_country}}</li>
                                    @else
                                        <p>Aucune d'entreprise enregistrée pour MMI3.</p>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <div class=" space-y-6">
                    <h4 class="text-center font-poppins font-semibold text-base">Remarque</h4>

                    @foreach ($visitsMMI3 as $visit)
                        @if($visit->note = null)
                            <p>Aucune remarque n'a été renseigné</p>
                        @else
                            <p>{{$visit->note}}</p>
                        @endif
                    @endforeach

                </div>
            @endif
        </div>
        </div>
</x-layout>

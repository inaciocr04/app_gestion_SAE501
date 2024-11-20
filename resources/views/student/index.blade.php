<x-layout title="Tableau de Bord Etudiant">
    <div x-data="{ showBut : 'but1' }" class="mt-6">
        <div class="flex flex-wrap sm:flex-row xs:space-y-4 lg:space-x-28 m-auto items-center justify-center w-fit xs:px-6 sm:px-8 lg:px-24 py-4 bg-secondary-color rounded-2xl">
            @foreach (['but1' => 'BUT1', 'but2' => 'BUT2', 'but3' => 'BUT3'] as $but => $label)
                <div @click="showBut = '{{ $but }}'"
                     :class="{'bg-seventh-color text-black': showBut === '{{ $but }}', 'text-white': showBut !== '{{ $but }}'}"
                     class="px-6 py-2 rounded-2xl cursor-pointer">
                    <p>Etudiant {{ $label }}</p>
                </div>
            @endforeach
        </div>

        @foreach (['but1' => 'MMI1', 'but2' => 'MMI2', 'but3' => 'MMI3'] as $but => $groupKey)
            <div x-show="showBut === '{{ $but }}'" class="bg-sixth-color h-full rounded mt-6 px-8 py-6">
                {{-- Vérification et affichage des visites --}}
                <h3 class="text-lg font-bold mb-4 mt-4">Information de l'entreprise</h3>
                @if (isset($visitsByTraining[$groupKey]) && $visitsByTraining[$groupKey]->isEmpty())
                    <p>Aucune visite enregistrée pour {{ $groupKey }}.</p>
                @else
                    <div>
                        @foreach ($visitsByTraining[$groupKey] as $visit)
                            @if($visit && $visit->company)
                                <div class="block lg:flex lg:flex-row lg:justify-evenly">
                                    <p><span class="font-poppins font-semibold">Nom de l'entreprise:</span> {{ $visit->company->company_name }}</p>
                                    <p><span class="font-poppins font-semibold">Adresse:</span> {{ $visit->company->company_address }}, {{ $visit->company->company_city }}, {{ $visit->company->company_postcode }}</p>
                                    <p><span class="font-poppins font-semibold">Pays:</span> {{ $visit->company->company_country }}</p>
                                    <p><span class="font-poppins font-semibold">Département:</span> {{ $visit->company->company_department }}</p>
                                </div>
                            @else
                                <p>Aucune entreprise enregistrée pour {{ $groupKey }}.</p>
                            @endif
                        @endforeach
                    </div>
                @endif

                {{-- Vérification et affichage des tuteurs --}}
                <h3 class="text-lg font-bold mb-4 mt-4">Information sur le tuteur</h3>
            @if (isset($statusByTraining[$groupKey]) && $statusByTraining[$groupKey]->isEmpty())
                    <p>Aucun tuteur enregistré pour {{ $groupKey }}.</p>
                @else
                    <div class="space-y-2">
                        @foreach ($statusByTraining[$groupKey] as $status)
                            @if($status->tutor)
                                <div class="block lg:flex lg:flex-row lg:justify-evenly">
                                    <p><span class="font-poppins font-semibold">Civilité:</span> {{ $status->tutor->civility }}</p>
                                    <p><span class="font-poppins font-semibold">Nom:</span> {{ $status->tutor->lastname }}</p>
                                    <p><span class="font-poppins font-semibold">Prénom:</span> {{ $status->tutor->firstname }}</p>
                                    <p><span class="font-poppins font-semibold">Email:</span> {{ $status->tutor->email }}</p>
                                    <p><span class="font-poppins font-semibold">N°téléphone:</span> {{ $status->tutor->telephone_number }}</p>
                                </div>
                            @else
                                <p>Aucun tuteur enregistré pour {{ $groupKey }}.</p>
                            @endif
                        @endforeach
                    </div>
                @endif

                {{-- Vérification et affichage des managers --}}
                <h3 class="text-lg font-bold mb-4 mt-4">Information sur le manager</h3>
            @if (isset($managersByTraining[$groupKey]) && $managersByTraining[$groupKey]->isEmpty())
                    <p>Aucun manager enregistré pour {{ $groupKey }}.</p>
                @else
                    <div class="space-y-2">
                        @foreach ($managersByTraining[$groupKey] as $manager)
                            @if($manager)
                                <div class="block lg:flex lg:flex-row lg:justify-evenly">
                                    <p><span class="font-poppins font-semibold">Civilité:</span> {{ $manager->company_manager_civility }}</p>
                                    <p><span class="font-poppins font-semibold">Nom:</span> {{ $manager->company_manager_lastname }}</p>
                                    <p><span class="font-poppins font-semibold">Prénom:</span> {{ $manager->company_manager_firstname }}</p>
                                    <p><span class="font-poppins font-semibold">Email:</span> {{ $manager->company_manager_email }}</p>
                                    <p><span class="font-poppins font-semibold">N°téléphone:</span> {{ $manager->company_manager_tel_number }}</p>
                                </div>
                                @else
                                <p>Aucun manager enregistré pour {{ $groupKey }}.</p>
                            @endif
                        @endforeach
                    </div>
                @endif

                {{-- Section remarques --}}
                <h3 class="text-lg font-bold mb-4 mt-4">Remarque</h3>
                @foreach ($visitsByTraining[$groupKey] as $visit)
                    <p>{{ $visit->note ?? "Aucune remarque n'a été renseignée" }}</p>
                @endforeach
            </div>
        @endforeach
    </div>
</x-layout>

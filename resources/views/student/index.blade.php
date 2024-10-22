<x-layout title="Tableau de Bord Etudiant">
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
        <div x-show="showBut === 'but1'" class="bg-sixth-color h-full mb-4">
            @if ($visitsMMI1->isEmpty())
                <p>Aucune visite enregistrée pour MMI1.</p>
            @else
                <ul>
                    @foreach ($visitsMMI1 as $visit)
                        @if($visit)
                        <li><span class="font-poppins font-semibold">Nom de l'entreprise:</span> {{$visit->company->company_name}}</li>
                        <li><span class="font-poppins font-semibold">Adresse:</span> {{$visit->company->company_address}}, {{$visit->company->company_city}}, {{$visit->company->company_postcode}} </li>
                        <li><span class="font-poppins font-semibold">Département:</span> {{$visit->company->company_departement}}</li>
                        <li><span class="font-poppins font-semibold">Pays:</span> {{$visit->company->company_country}}</li>
                        @else
                            <p>Aucune visite enregistrée pour MMI1.</p>
                        @endif
                    @endforeach
                </ul>
            @endif
            @if ($statusMMI1->isEmpty())
                <p>Aucune visite enregistrée pour MMI1.</p>
            @else
                <ul>
                    @foreach ($statusMMI1 as $studentStatu)
                        @if($studentStatu->tutor)
                            <li><span class="font-poppins font-semibold">Civilité:</span> {{$studentStatu->tutor->civility}}</li>
                            <li><span class="font-poppins font-semibold">Nom:</span> {{$studentStatu->tutor->lastname}}</li>
                            <li><span class="font-poppins font-semibold">Prénom:</span> {{$studentStatu->tutor->firstname}}</li>
                            <li><span class="font-poppins font-semibold">Email:</span> {{$studentStatu->tutor->email}}</li>
                            <li><span class="font-poppins font-semibold">N°téléphone:</span> {{$studentStatu->tutor->telephone_number}}</li>
                        @else
                            <p>Aucun tuteur enregistrée pour MMI1.</p>
                        @endif
                    @endforeach
                </ul>
            @endif
            @if ($visitsMMI1->isEmpty())
                <p>Aucun manager enregistrée pour MMI1.</p>
            @else
                <ul>
                    @foreach ($visitsMMI1 as $visit)
                        <li><span class="font-poppins font-semibold">Civilité:</span> {{$visit->company->company_manager_civility}}</li>
                        <li><span class="font-poppins font-semibold">Nom:</span> {{$visit->company->company_manager_lastname}}</li>
                        <li><span class="font-poppins font-semibold">Prénom:</span> {{$visit->company->company_manager_firstname}}</li>
                        <li><span class="font-poppins font-semibold">Email:</span> {{$visit->company->company_manager_email}}</li>
                        <li><span class="font-poppins font-semibold">N°téléphone:</span> {{$visit->company->company_manager_tel_number}}</li>
                    @endforeach
                </ul>
            @endif
            <h4>Remarque</h4>
            @foreach ($visitsMMI1 as $visit)
                @if($visit->note = null)
                    <p>Aucune remarque n'a été renseigné</p>
                @else
                    <p>{{$visit->note}}</p>
                @endif
            @endforeach
        </div>
    <div x-show="showBut === 'but2'" class="bg-sixth-color h-full mb-4">
        @if ($visitsMMI2->isEmpty())
            <p>Aucune visite enregistrée pour MMI2.</p>
        @else
            <ul>
                @foreach ($visitsMMI2 as $visit)
                    <li><span class="font-poppins font-semibold">Nom de l'entreprise:</span> {{$visit->company->company_name}}</li>
                    <li><span class="font-poppins font-semibold">Adresse:</span> {{$visit->company->company_address}}, {{$visit->company->company_city}}, {{$visit->company->company_postcode}} </li>
                    <li><span class="font-poppins font-semibold">Département:</span> {{$visit->company->company_departement}}</li>
                    <li><span class="font-poppins font-semibold">Pays:</span> {{$visit->company->company_country}}</li>
                @endforeach
            </ul>
        @endif
        @if ($statusMMI2->isEmpty())
            <p>Aucune visite enregistrée pour MMI2.</p>
        @else
            <ul>
                @foreach ($statusMMI2 as $studentStatu)
                    <li><span class="font-poppins font-semibold">Civilité:</span> {{$studentStatu->tutor->civility}}</li>
                    <li><span class="font-poppins font-semibold">Nom:</span> {{$studentStatu->tutor->lastname}}</li>
                    <li><span class="font-poppins font-semibold">Prénom:</span> {{$studentStatu->tutor->firstname}}</li>
                    <li><span class="font-poppins font-semibold">Email:</span> {{$studentStatu->tutor->email}}</li>
                    <li><span class="font-poppins font-semibold">N°téléphone:</span> {{$studentStatu->tutor->telephone_number}}</li>
                @endforeach
            </ul>
        @endif
        @if ($visitsMMI2->isEmpty())
            <p>Aucune visite enregistrée pour MMI2.</p>
        @else
            <ul>
                @foreach ($visitsMMI2 as $visit)
                    <li><span class="font-poppins font-semibold">Civilité:</span> {{$visit->company->company_manager_civility}}</li>
                    <li><span class="font-poppins font-semibold">Nom:</span> {{$visit->company->company_manager_lastname}}</li>
                    <li><span class="font-poppins font-semibold">Prénom:</span> {{$visit->company->company_manager_firstname}}</li>
                    <li><span class="font-poppins font-semibold">Email:</span> {{$visit->company->company_manager_email}}</li>
                    <li><span class="font-poppins font-semibold">N°téléphone:</span> {{$visit->company->company_manager_tel_number}}</li>
                @endforeach
            </ul>
        @endif
        <h4>Remarque</h4>
        @foreach ($visitsMMI2 as $visit)
            @if($visit->note = null)
                <p>Aucune remarque n'a été renseigné</p>
            @else
                <p>{{$visit->note}}</p>
            @endif
        @endforeach
    </div>
        <div x-show="showBut === 'but3'" class="bg-sixth-color h-full mb-4">
            @if ($visitsMMI3->isEmpty())
                <p>Aucune visite enregistrée pour MMI3.</p>
            @else
                <ul>
                    @foreach ($visitsMMI3 as $visit)
                        <li><span class="font-poppins font-semibold">Nom de l'entreprise:</span> {{$visit->company->company_name}}</li>
                        <li><span class="font-poppins font-semibold">Adresse:</span> {{$visit->company->company_address}}, {{$visit->company->company_city}}, {{$visit->company->company_postcode}} </li>
                        <li><span class="font-poppins font-semibold">Département:</span> {{$visit->company->company_departement}}</li>
                        <li><span class="font-poppins font-semibold">Pays:</span> {{$visit->company->company_country}}</li>
                    @endforeach
                </ul>
            @endif
            @if ($statusMMI3->isEmpty())
                <p>Aucune visite enregistrée pour MMI3.</p>
            @else
                <ul>
                    @foreach ($statusMMI3 as $studentStatu)
                        @if($studentStatu->tutor)
                            <li><span class="font-poppins font-semibold">Civilité:</span> {{$studentStatu->tutor->civility}}</li>
                            <li><span class="font-poppins font-semibold">Nom:</span> {{$studentStatu->tutor->lastname}}</li>
                            <li><span class="font-poppins font-semibold">Prénom:</span> {{$studentStatu->tutor->firstname}}</li>
                            <li><span class="font-poppins font-semibold">Email:</span> {{$studentStatu->tutor->email}}</li>
                            <li><span class="font-poppins font-semibold">N°téléphone:</span> {{$studentStatu->tutor->telephone_number}}</li>
                        @else
                            <p>Aucune visite enregistrée pour MMI3.</p>
                        @endif
                    @endforeach
                </ul>
            @endif
            @if ($visitsMMI3->isEmpty())
                <p>Aucune visite enregistrée pour MMI3.</p>
            @else
                <ul>
                    @foreach ($visitsMMI3 as $visit)
                        <li><span class="font-poppins font-semibold">Civilité:</span> {{$visit->company->company_manager_civility}}</li>
                        <li><span class="font-poppins font-semibold">Nom:</span> {{$visit->company->company_manager_lastname}}</li>
                        <li><span class="font-poppins font-semibold">Prénom:</span> {{$visit->company->company_manager_firstname}}</li>
                        <li><span class="font-poppins font-semibold">Email:</span> {{$visit->company->company_manager_email}}</li>
                        <li><span class="font-poppins font-semibold">N°téléphone:</span> {{$visit->company->company_manager_tel_number}}</li>
                    @endforeach
                </ul>
            @endif
            <h4>Remarque</h4>
            @foreach ($visitsMMI3 as $visit)
                @if($visit->note = null)
                    <p>Aucune remarque n'a été renseigné</p>
                @else
                    <p>{{$visit->note}}</p>
                @endif
            @endforeach
        </div>
</x-layout>

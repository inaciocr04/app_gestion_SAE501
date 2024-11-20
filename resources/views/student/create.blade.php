<x-layout title="Création d'un étudiant">
    <div x-data="{ step: 1 }">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('manager.student.store') }}" method="POST" class="px-6 py-4">
            @csrf

            <div x-show="step === 1" class="space-y-4">

                    <h2 class="font-bold text-lg">Informations personnelles</h2>
                <div class="block lg:flex w-full space-y-4 lg:space-y-0 lg:space-x-7">
                    <x-form.input name_label="Nom" name="lastname" value=""/>
                    <x-form.input name_label="Prénom" name="firstname" value=""/>
                    <x-form.input name_label="Date de naissance" name="date_birth" type="date" value=""/>
                </div>
                <div class="block lg:flex w-full space-y-4 lg:space-y-0 lg:space-x-7">
                    <x-form.input name_label="Numéro étudiant" name="student_number" value=""/>
                    <x-form.input name_label="Email unistra" name="unistra_email" type="email" value=""/>
                </div>
                <div class="block lg:flex w-full space-y-4 lg:space-y-0 lg:space-x-7">
                    <x-form.input name_label="Numéro de téléphone" name="telephone_number" value=""/>
                    <x-form.input name_label="Email personnel" name="personal_email" type="email" value=""/>
                </div>
                <div class="block lg:flex w-full space-y-4 lg:space-y-0 lg:space-x-7">
                    <x-form.input name_label="Adresse" name="address" value=""/>
                    <x-form.input name_label="Code postal" name="postcode" value=""/>
                    <x-form.input name_label="Ville" name="city" value=""/>
                </div>
                <div class="block lg:flex w-full space-y-4 lg:space-y-0 lg:space-x-7">
                    <x-form.input name_label="Numéro de téléphone permanent (Facultatif)" name="permanent_telephone_number" value=""/>
                    <x-form.input name_label="Adresse permanente (Facultatif)" name="permanent_address" value=""/>
                    <x-form.input name_label="Code postal permanent (Facultatif)" name="permanent_postcode" value=""/>
                    <x-form.input name_label="Ville permanente (Facultatif)" name="permanent_city" value=""/>
                </div>
                <p class="flex bg-seventh-color px-6 py-2 rounded-lg mt-4 w-fit" @click="step++">Suivant <x-heroicon-c-arrow-long-right class="w-6 h-auto" /></p>
            </div>

            <div x-show="step === 2" class="space-y-4">
                <h2 class="font-bold text-lg">Informations personnelles</h2>
                <div class="block lg:flex space-y-4 lg:space-y-0 lg:space-x-20">
                    <div class="flex items-center w-full">
                        <label for="year_training" class="w-full text-gray-700 font-bold">Formation
                            <select name="year_training_id" id="year_training_id" required class="form-select w-full rounded">
                                <option value="">-- Sélectionner une formation --</option>
                            @foreach($year_trainings as $year_training)
                                    <option value="{{ $year_training->id }}">
                                        {{ $year_training->training_title }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                    <div class="flex items-center w-full">
                        <label for="actual_year" class="w-full text-gray-700 font-bold">Année
                            <select name="actual_year_id" id="actual_year_id" required class="form-select w-full rounded">
                                <option value="">-- Sélectionner une année --</option>
                            @foreach($actual_years as $actual_year)
                                    <option value="{{ $actual_year->id }}">
                                        {{ $actual_year->year_title }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                    <div class="flex items-center w-full">
                        <label for="training_courses" class="w-full text-gray-700 font-bold">Parcours (Facultatif)
                            <select name="training_courses_id" id="training_courses_id" required class="form-select w-full rounded">
                                <option value="">-- Sélectionner un parcour --</option>
                            @foreach($training_courses as $training_course)
                                    <option value="{{ $training_course->id }}">
                                        {{ $training_course->course_title }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                </div>
                <div class="block lg:flex space-y-4 lg:space-y-0 lg:space-x-20">
                    <div class="flex items-center w-full">
                        <label for="td_group" class="w-full text-gray-700 font-bold">Groupe de TD
                            <select name="group_td_id" id="group_td_id" required class="form-select w-full rounded">
                                <option value="">-- Sélectionner un groupe de TD --</option>

                            @foreach($td_groups as $td_group)
                                    <option value="{{ $td_group->id }}">
                                        {{ $td_group->td_name }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                    <div class="flex items-center w-full">
                        <label for="tp_group" class="w-full text-gray-700 font-bold">Groupe de TP
                            <select name="group_tp_id" id="group_tp_id" required class="form-select w-full rounded">
                                <option value="">-- Sélectionner un groupe de TP --</option>

                            @foreach($tp_groups as $tp_group)
                                    <option value="{{ $tp_group->id }}">
                                        {{ $tp_group->tp_name }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                    <div class="flex items-center w-full">
                        <label for="statut" class="w-full text-gray-700 font-bold">Statut
                            <select name="statuts_id" id="statuts_id" required class="form-select w-full rounded">
                                <option value="">-- Sélectionner un statut --</option>

                            @foreach($statuts as $statut)
                                    <option value="{{ $statut->id }}">
                                        {{ $statut->statut_title }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                </div>
                <x-form.input type="date" name_label="Date de début parcours" name="start_date" value=""/>
                <div class="block lg:flex w-full space-y-4 lg:space-y-0 lg:space-x-7">
                    <x-form.input type="date" name_label="Date de début du status (Facultatif)" name="start_date_status" value=""/>
                    <x-form.input type="date" name_label="Date de fin du status (Facultatif)" name="end_date_status" value=""/>
                </div>
                <div class="flex space-x-7">
                    <p class="flex bg-seventh-color px-6 py-2 rounded-lg mt-4" @click="step--"><x-heroicon-c-arrow-long-left class="w-6 h-auto" /> Précédent</p>
                    <p class="flex bg-seventh-color px-6 py-2 rounded-lg mt-4" @click="step++">Suivant <x-heroicon-c-arrow-long-right class="w-6 h-auto" /></p>
                </div>
            </div>

            <div x-show="step === 3" class="space-y-4">
                <h2 class="font-bold text-lg">Informations entreprises</h2>
                <div class="block lg:flex w-full space-y-4 lg:space-y-0 lg:space-x-7">
                    <livewire:tutor-select/>

                    <livewire:company-select/>
                </div>
                <div class="flex items-center w-full">
                    <label for="teacher" class="w-full text-gray-700 font-bold">Professeur (Facultatif)
                        <select name="teachers_id" id="teachers_id" class="form-select w-full rounded">
                            @if(empty($teachers_id))
                                <option value="">-- Sélectionner un professeur --</option>
                            @endif
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">
                                    {{ $teacher->firstname }} {{ $teacher->lastname }}
                                </option>
                            @endforeach

                        </select>
                    </label>
                </div>

                <div class="block lg:flex w-full space-y-4 lg:space-y-0 lg:space-x-7">
                    <x-form.input type="date" name_label="Date de début en entreprise (Facultatif)" name="start_date_company" value=""/>
                    <x-form.input type="date" name_label="Date de fin en entreprise (Facultatif)" name="end_date_company" value=""/>
                </div>

                <div class="flex space-x-7">
                    <p class="flex bg-seventh-color px-6 py-2 rounded-lg mt-4" @click="step--"><x-heroicon-c-arrow-long-left class="w-6 h-auto" /> Précédent</p>
                    <p class="flex bg-seventh-color px-6 py-2 rounded-lg mt-4" @click="step++">Suivant <x-heroicon-c-arrow-long-right class="w-6 h-auto" /></p>
                </div>
            </div>

            <div x-show="step === 4" class="space-y-4">
                <h2 class="font-bold text-lg">Informations sur la visite éffectué</h2>
                <div class="mb-4">
                    <label class="text-gray-700 font-bold">Visit effectuer ? (Facultatif)</label>
                    <div class="mt-2">
                        <label class="inline-flex items-center">
                            <input type="radio" name="visit_statu" value="oui" class="form-radio">
                            <span class="ml-2">Oui</span>
                        </label>
                        <label class="inline-flex items-center ml-4">
                            <input type="radio" name="visit_statu" value="non" class="form-radio">
                            <span class="ml-2">Non</span>
                        </label>
                    </div>
                </div>
                <div class="block lg:flex w-full space-y-4 lg:space-y-0 lg:space-x-7">
                    <x-form.input type="datetime-local" name_label="Date de début de la visite (Facultatif)" name="start_date_visit" value=""/>
                    <x-form.input type="datetime-local" name_label="Date de fin de la visite (Facultatif)" name="end_date_visit" value=""/>
                </div>
                <div class="mb-4">
                    <label class="text-gray-700 font-bold" for="note">Notes (Facultatif)</label>
                    <textarea name="note" id="note" rows="4" class=" form-textarea mt-1 block w-full rounded shadow-sm resize-none h-32"></textarea>
                </div>

                <p class="flex bg-seventh-color px-6 py-2 rounded-lg mt-4 w-fit" @click="step--"><x-heroicon-c-arrow-long-left class="w-6 h-auto" /> Précédent</p>
                <x-form.button name="Créer"/>
            </div>

        </form>
    </div>
</x-layout>

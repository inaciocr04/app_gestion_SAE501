<x-layout title="Création d'un étudiant">
    <div x-data="{ step: 1 }">
        <h1>Créer un étudiant</h1>

        <form action="{{ route('manager.student.store') }}" method="POST">
            @csrf

            <div x-show="step === 1" class="step">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h2>Informations personnelles</h2>
                <div class="flex">
                    <x-form.input name_label="Nom" name="lastname" value=""/>
                    <x-form.input name_label="Prénom" name="firstname" value=""/>
                    <x-form.input name_label="Date de naissance" name="date_birth" type="date" value=""/>
                    <x-form.input name_label="Numéro étudiant" name="student_number" value=""/>
                    <x-form.input name_label="Numéro de téléphone" name="telephone_number" value=""/>
                    <x-form.input name_label="Email personnel" name="personal_email" type="email" value=""/>
                    <x-form.input name_label="Email unistra" name="unistra_email" type="email" value=""/>
                </div>
                <div class="flex">
                    <x-form.input name_label="Adresse" name="address" value=""/>
                    <x-form.input name_label="Code postal" name="postcode" value=""/>
                    <x-form.input name_label="Ville" name="city" value=""/>
                </div>
                <p class="flex bg-seventh-color px-6 py-2 rounded-lg mt-4 w-fit" @click="step++">Suivant <x-heroicon-c-arrow-long-right class="w-6 h-auto" /></p>
            </div>

            <div x-show="step === 2" class="step">
                <h2>Informations de formation</h2>
                <div class="flex">
                    <label for="year_training">Formation :</label>
                    <select name="year_training_id" id="year_training_id" required>
                        <option value="">-- Sélectionner une formation --</option>
                        @foreach($year_trainings as $year_training)
                            <option value="{{ $year_training->id }}">
                                {{ $year_training->training_title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex">
                    <label for="actual_year">Année :</label>
                    <select name="actual_year_id" id="actual_year_id" required>
                        <option value="">-- Sélectionner une année --</option>
                        @foreach($actual_years as $actual_year)
                            <option value="{{ $actual_year->id }}">
                                {{ $actual_year->year_title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex">
                    <label for="td_group">Groupe de TD :</label>
                    <select name="group_td_id" id="group_td_id" required>
                        <option value="">-- Sélectionner un groupe de TD --</option>
                        @foreach($td_groups as $td_group)
                            <option value="{{ $td_group->id }}">
                                {{ $td_group->td_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex">
                    <label for="tp_group">Groupe de TP :</label>
                    <select name="group_tp_id" id="group_tp_id" required>
                        <option value="">-- Sélectionner un groupe de TP --</option>
                        @foreach($tp_groups as $tp_group)
                            <option value="{{ $tp_group->id }}">
                                {{ $tp_group->tp_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex">
                    <label for="training_courses">Parcours :</label>
                    <select name="training_courses_id" id="training_courses_id" required>
                        <option value="">-- Sélectionner un parcour --</option>
                        @foreach($training_courses as $training_course)
                            <option value="{{ $training_course->id }}">
                                {{ $training_course->course_title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex">
                    <label for="statut">Statut :</label>
                    <select name="statuts_id" id="statuts_id" required>
                        <option value="">-- Sélectionner un statut --</option>
                        @foreach($statuts as $statut)
                            <option value="{{ $statut->id }}">
                                {{ $statut->statut_title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <x-form.input type="date" name_label="Date de début parcours" name="start_date" value=""/>
                <x-form.input type="date" name_label="Date de début du status" name="start_date_status" value=""/>
                <x-form.input type="date" name_label="Date de fin du status" name="end_date_status" value=""/>
                <div class="flex space-x-7">
                    <p class="flex bg-seventh-color px-6 py-2 rounded-lg mt-4" @click="step--"><x-heroicon-c-arrow-long-left class="w-6 h-auto" /> Précédent</p>
                    <p class="flex bg-seventh-color px-6 py-2 rounded-lg mt-4" @click="step++">Suivant <x-heroicon-c-arrow-long-right class="w-6 h-auto" /></p>
                </div>
            </div>

            <div x-show="step === 3" class="step">
                <h2>Informations entreprises</h2>


                <livewire:tutor-select/>
                <div class="flex">
                    <label for="teacher">Professeur :</label>
                    <select name="teachers_id" id="teachers_id">
                        <option value="">-- Sélectionner un professeur --</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">
                                {{ $teacher->firstname }} {{ $teacher->lastname }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <livewire:company-select/>

                <x-form.input type="date" name_label="Date de début en entreprise" name="start_date_company" value=""/>
                <x-form.input type="date" name_label="Date de fin en entreprise" name="end_date_company" value=""/>

                <div class="flex space-x-7">
                    <p class="flex bg-seventh-color px-6 py-2 rounded-lg mt-4" @click="step--"><x-heroicon-c-arrow-long-left class="w-6 h-auto" /> Précédent</p>
                    <p class="flex bg-seventh-color px-6 py-2 rounded-lg mt-4" @click="step++">Suivant <x-heroicon-c-arrow-long-right class="w-6 h-auto" /></p>
                </div>
            </div>

            <div x-show="step === 4" class="step">
                <h2>Informations sur la visite éffectué</h2>
                <div class="flex">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Statut de la visite :</label>
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
                    <div class="mb-4">
                        <label for="note" class="block text-sm font-medium text-gray-700">Notes :</label>
                        <textarea name="note" id="note" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>
                    <x-form.input type="datetime-local" name_label="Date de début de la visite" name="start_date_visit" value=""/>
                    <x-form.input type="c" name_label="Date de fin de la visite" name="end_date_visit" value=""/>
                </div>
                <p class="flex bg-seventh-color px-6 py-2 rounded-lg mt-4 w-fit" @click="step--"><x-heroicon-c-arrow-long-left class="w-6 h-auto" /> Précédent</p>
                <x-form.button name="Créer"/>
            </div>

        </form>
    </div>
</x-layout>

<x-layout title="Création d'un étudiant">
    <div x-data="{ step: 1 }">
        <h1>{{ isset($student) ? 'Modifier' : 'Créer' }} un étudiant</h1>

        <form action="{{ route('student.store') }}" method="POST">
            @csrf

            <div x-show="step === 1" class="step">
                <h2>Informations personnelles</h2>
                <div class="flex">
                    <x-form.input name_label="Nom" name="lastname" value="{{ old('lastname', $student->lastname) }}"/>
                    <x-form.input name_label="Prénom" name="firstname" value="{{ old('firstname', isset($student) ? $student->firstname : '') }}"/>
                    <x-form.input name_label="Date de naissance" name="date_birth" type="date" value="{{ old('date_birth', isset($student) ? $student->date_birth : '') }}"/>
                    <x-form.input name_label="Numéro étudiant" name="student_number" value="{{ old('student_number', isset($student) ? $student->student_number : '') }}"/>
                    <x-form.input name_label="Numéro de téléphone" name="telephone_number" value="{{ old('telephone_number', isset($student) ? $student->telephone_number : '') }}"/>
                    <x-form.input name_label="Email personnel" name="personal_email" type="email" value="{{ old('personal_email', isset($student) ? $student->personal_email : '') }}"/>
                    <x-form.input name_label="Email unistra" name="unistra_email" type="email" value="{{ old('unistra_email', isset($student) ? $student->unistra_email : '') }}"/>
                </div>
                <div class="flex">
                    <x-form.input name_label="Adresse" name="address" value="{{ old('address', isset($student) ? $student->address : '') }}"/>
                    <x-form.input name_label="Code postal" name="postcode" value="{{ old('postcode', isset($student) ? $student->postcode : '') }}"/>
                    <x-form.input name_label="Ville" name="city" value="{{ old('city', isset($student) ? $student->city : '') }}"/>
                </div>
                <button class="flex bg-seventh-color px-6 py-2 rounded-lg mt-4" @click="step++">Suivant <x-heroicon-c-arrow-long-right class="w-6 h-auto" /></button>
            </div>

            <div x-show="step === 2" class="step">
                <h2>Informations de formation</h2>
                <div class="flex">
                    <label for="year_training">Formation :</label>
                    <select name="year_training_id" id="year_training_id">
                        @foreach($year_trainings as $year_training)
                            <option value="{{ $year_training->id }}"
                                    @if($year_training->id == $year_training_id) selected @endif>
                                {{ $year_training->training_title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex">
                    <label for="actual_year">Année :</label>
                    <select name="actual_year_id" id="actual_year" required>
                            <option value="">-- Sélectionner une année --</option>
                            @foreach($actual_years as $actual_year)
                                <option value="{{ $actual_year->id }}" {{ (old('actual_year_id') == $actual_year->id) ? 'selected' : '' }}>
                                    {{ $actual_year->year_title }}
                                </option>
                            @endforeach
                    </select>
                </div>
                <div class="flex">
                    <label for="td_group">Groupe de TD :</label>
                    <select name="group_td_id" id="td_group" required>
                        <option value="">-- Sélectionner un groupe de TD --</option>
                        @foreach($td_groups as $td_group)
                            <option value="{{ $td_group->id }}" {{ (old('group_td_id') == $td_group->id) ? 'selected' : '' }}>
                                {{ $td_group->td_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex">
                    <label for="tp_group">Groupe de TP :</label>
                    <select name="group_tp_id" id="tp_group" required>
                        <option value="">-- Sélectionner un groupe de TP --</option>
                        @foreach($tp_groups as $tp_group)
                            <option value="{{ $tp_group->id }}" {{ (old('group_tp_id') == $tp_group->id) ? 'selected' : '' }}>
                                {{ $tp_group->tp_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex">
                    <label for="training_courses">Parcours :</label>
                    <select name="training_courses_id" id="training_courses" required>
                        <option value="">-- Sélectionner un parcour --</option>
                        @foreach($training_courses as $training_course)
                            <option value="{{ $training_course->id }}" {{ (old('training_courses_id') == $training_course->id) ? 'selected' : '' }}>
                                {{ $training_course->course_title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex">
                    <label for="statut">Statut :</label>
                    <select name="statut_id" id="statut" required>
                        <option value="">-- Sélectionner un statut --</option>
                        @foreach($statuts as $statut)
                            <option value="{{ $statut->id }}" {{ (old('statut_id') == $statut->id) ? 'selected' : '' }}>
                                {{ $statut->statut_title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <x-form.input type="date" name_label="Date de début parcours" name="start_date" value="{{ old('start_date', isset($student) && $student->courses->isNotEmpty() ? $student->courses->first()->start_date : '') }}"/>
                <x-form.input type="date" name_label="Date de début du status" name="start_date_status" value="{{ old('start_date_status', isset($student) && $student->student_statu->isNotEmpty() ? $student->student_statu->first()->start_date_status : '') }}"/>
                <x-form.input type="date" name_label="Date de fin du status" name="end_date_status" value="{{ old('end_date_status', isset($student) && $student->student_statu->isNotEmpty() ? $student->student_statu->first()->end_date_status : '') }}"/>
                <div class="flex space-x-7">
                    <button class="flex bg-seventh-color px-6 py-2 rounded-lg mt-4" @click="step--"><x-heroicon-c-arrow-long-left class="w-6 h-auto" /> Précédent</button>
                    <button class="flex bg-seventh-color px-6 py-2 rounded-lg mt-4" @click="step++">Suivant <x-heroicon-c-arrow-long-right class="w-6 h-auto" /></button>
                </div>
            </div>

            <div x-show="step === 3" class="step">
                <h2>Informations entreprises</h2>

                <div class="flex">
                    <label for="tutor">Tuteur :</label>
                    <select name="tutor_id" id="tutor">
                        <option value="">-- Sélectionner un tuteur --</option>
                        @foreach($tutors as $tutor)
                            <option value="{{ $tutor->id }}" {{ (old('tutor_id') == $tutor->id) ? 'selected' : '' }}>
                                {{ $tutor->firstname }} {{ $tutor->lastname }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex">
                    <label for="teacher">Professeur :</label>
                    <select name="teacher_id" id="teacher">
                        <option value="">-- Sélectionner un professeur --</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ (old('teacher_id') == $teacher->id) ? 'selected' : '' }}>
                                {{ $teacher->firstname }} {{ $teacher->lastname }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex">
                    <label for="teacher">Entreprise :</label>
                    <select name="teacher_id" id="teacher">
                        <option value="">-- Sélectionner une entreprise --</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}" {{ (old('company_id') == $company->id) ? 'selected' : '' }}>
                                {{ $company->company_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <x-form.input type="date" name_label="Date de début en entreprise" name="start_date_company" value="{{ old('start_date_company', isset($student) && $student->student_statu->isNotEmpty() ? $student->student_statu->first()->start_date_company : '') }}"/>
                <x-form.input type="date" name_label="Date de fin en entreprise" name="end_date_company" value="{{ old('end_date_company', isset($student) && $student->student_statu->isNotEmpty() ? $student->student_statu->first()->end_date_company : '') }}"/>

                <div class="flex space-x-7">
                    <button class="flex bg-seventh-color px-6 py-2 rounded-lg mt-4" @click="step--"><x-heroicon-c-arrow-long-left class="w-6 h-auto" /> Précédent</button>
                    <button class="flex bg-seventh-color px-6 py-2 rounded-lg mt-4" @click="step++">Suivant <x-heroicon-c-arrow-long-right class="w-6 h-auto" /></button>
                </div>
            </div>

            <div x-show="step === 4" class="step">
                <h2>Informations sur la visite éffectué</h2>
                <div class="flex">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Statut de la visite :</label>
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input type="radio" name="visit_statu" value="oui" {{ old('visit_statu') == 'oui' ? 'checked' : '' }} class="form-radio">
                                <span class="ml-2">Oui</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input type="radio" name="visit_statu" value="non" {{ old('visit_statu') == 'non' ? 'checked' : '' }} class="form-radio">
                                <span class="ml-2">Non</span>
                            </label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="note" class="block text-sm font-medium text-gray-700">Notes :</label>
                        <textarea name="note" id="note" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('note') }}</textarea>
                    </div>
                    <x-form.input type="date" name_label="Date de début de la visite" name="start_date_visit" value="{{ old('start_date_visit', isset($student) && $student->visits->isNotEmpty() ? $student->visits->first()->start_date_visit : '') }}"/>
                    <x-form.input type="date" name_label="Date de fin de la visite" name="end_date_visit" value="{{ old('end_date_visit', isset($student) && $student->visits->isNotEmpty() ? $student->visits->first()->end_date_visit : '') }}"/>
                </div>
                <button class="flex bg-seventh-color px-6 py-2 rounded-lg mt-4" @click="step--"><x-heroicon-c-arrow-long-left class="w-6 h-auto" /> Précédent</button>
                <x-form.button name="Créer"/>
            </div>

        </form>
    </div>
</x-layout>

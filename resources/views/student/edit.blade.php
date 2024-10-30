@php
    use \Carbon\Carbon;
@endphp

<x-layout title="Création d'un étudiant">
    <div x-data="{ step: 1 }">
        <h1>Modifier les donnée de {{$student->lastname}} {{$student->firstname}}</h1>
        <x-link.back href="{{route('global.students')}}"/>

        <form action="{{ route('student.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div x-show="step === 1" class="step">
                <h2>Informations personnelles</h2>
                <div class="flex">
                    <x-form.input name_label="Nom" name="lastname" value="{{ old('lastname', $student->lastname) }}"/>
                    <x-form.input name_label="Prénom" name="firstname" value="{{ old('firstname', $student->firstname ) }}"/>
                    <x-form.input name_label="Date de naissance" name="date_birth" type="date" value="{{ old('date_birth', $student->date_birth) }}"/>
                    <x-form.input name_label="Numéro étudiant" name="student_number" value="{{ old('student_number', $student->student_number ) }}"/>
                    <x-form.input name_label="Numéro de téléphone" name="telephone_number" value="{{ old('telephone_number', $student->telephone_number ) }}"/>
                    <x-form.input name_label="Email personnel" name="personal_email" type="email" value="{{ old('personal_email', $student->personal_email ) }}"/>
                    <x-form.input name_label="Email unistra" name="unistra_email" type="email" value="{{ old('unistra_email', $student->unistra_email ) }}"/>
                </div>
                <div class="flex">
                    <x-form.input name_label="Adresse" name="address" value="{{ old('address', $student->address ) }}"/>
                    <x-form.input name_label="Code postal" name="postcode" value="{{ old('postcode', $student->postcode ) }}"/>
                    <x-form.input name_label="Ville" name="city" value="{{ old('city', $student->city ) }}"/>
                </div>
                <p class="flex bg-seventh-color px-6 py-2 rounded-lg mt-4 w-fit cursor-pointer" @click="step++">Suivant <x-heroicon-c-arrow-long-right class="w-6 h-auto" /></p>
            </div>

            <div x-show="step === 2" class="step">
                <h2>Informations de formation</h2>
                <div class="flex">
                    <label for="year_training">Formation :</label>
                    <select name="year_training_id" id="year_training_id">
                        @foreach($year_trainings as $year_training)
                            <option value="{{ $year_training->id }}"
                                {{ $year_training_id == $year_training->id ? 'selected' : '' }}>
                                {{ $year_training->training_title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex">
                    <label for="actual_year">Année :</label>
                    <select name="actual_year_id" id="actual_year_id">
                        @foreach($actual_years as $actual_year)
                            <option value="{{ $actual_year->id }}"
                                    @if($actual_year->id == $actual_year_id) selected @endif>
                                {{ $actual_year->year_title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex">
                    <label for="td_group">Groupe de TD :</label>
                    <select name="group_td_id" id="group_td_id" required>
                        @foreach($td_groups as $td_group)
                            <option value="{{ $td_group->id }}"
                                @if($td_group->id == $group_td_id) selected @endif>
                                {{ $td_group->td_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex">
                    <label for="tp_group">Groupe de TP :</label>
                    <select name="group_tp_id" id="group_tp_id" required>
                        @foreach($tp_groups as $tp_group)
                            <option value="{{ $tp_group->id }}"
                                    @if($tp_group->id == $group_tp_id) selected @endif>
                                {{ $tp_group->tp_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex">
                    <label for="training_courses">Parcours :</label>
                    <select name="training_courses_id" id="training_courses_id" required>
                        @foreach($training_courses as $training_course)
                            <option value="{{ $training_course->id }}"
                                    @if($training_course->id == $training_courses_id) selected @endif>
                                {{ $training_course->course_title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex">
                    <label for="statut">Statut :</label>
                    <select name="statuts_id" id="statuts_id" required>
                        @foreach($statuts as $statut)
                            <option value="{{ $statut->id }}"
                                    @if($statut->id == $statuts_id) selected @endif>
                                {{ $statut->statut_title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <x-form.input type="date" name_label="Date de début parcours" name="start_date"
                              value="{{ old('start_date', isset($course) && $course->start_date ? Carbon::parse($course->start_date)->format('Y-m-d') : '') }}" />

                <x-form.input type="date" name_label="Date de début du statut" name="start_date_status"
                              value="{{ old('start_date_status', isset($student_statu) && $student_statu->start_date_status ? Carbon::parse($student_statu->start_date_status)->format('Y-m-d') : '') }}" />

                <x-form.input type="date" name_label="Date de fin du statut" name="end_date_status"
                              value="{{ old('end_date_status', isset($student_statu) && $student_statu->end_date_status ? Carbon::parse($student_statu->end_date_status)->format('Y-m-d') : '') }}" />


                <div class="flex space-x-7">
                    <p class="flex bg-seventh-color px-6 py-2 rounded-lg mt-4 w-fit cursor-pointer" @click="step--"><x-heroicon-c-arrow-long-left class="w-6 h-auto" /> Précédent</p>
                    <p class="flex bg-seventh-color px-6 py-2 rounded-lg mt-4 w-fit cursor-pointer" @click="step++">Suivant <x-heroicon-c-arrow-long-right class="w-6 h-auto" /></p>
                </div>
            </div>

            <div x-show="step === 3" class="step">
                <h2>Informations entreprises</h2>
                <div class="flex">
                    <label for="tutor">Tuteur :</label>
                    <select name="tutors_id" id="tutors_id">
                        @if(empty($tutors_id))
                            <option value="">-- Sélectionner un tuteur --</option>
                        @endif
                        @foreach($tutors as $tutor)
                            <option value="{{ $tutor->id }}"
                                    @if($tutor->id == $tutors_id) selected @endif>
                                {{ $tutor->firstname }} {{ $tutor->lastname }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex">
                    <label for="teacher">Professeur :</label>
                    <select name="teachers_id" id="teachers_id">
                        @if(empty($teachers_id))
                            <option value="">-- Sélectionner un professeur --</option>
                        @endif
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}"
                                    @if($teacher->id == $teachers_id) selected @endif>
                                {{ $teacher->firstname }} {{ $teacher->lastname }}
                            </option>
                        @endforeach

                    </select>
                </div>
                <div class="flex">
                    <label for="teacher">Entreprise :</label>
                    <select name="companies_id" id="companies_id">
                        @if(empty($companies_id))
                            <option value="">-- Sélectionner une entreprise --</option>
                        @endif
                            @foreach($companies as $company)
                            <option value="{{ $company->id }}"
                                    @if($company->id == $companies_id) selected @endif>
                                {{ $company->company_name }}
                            </option>
                        @endforeach

                    </select>
                </div>
                <x-form.input type="date" name_label="Date de début en entreprise" name="start_date_company" value="{{ old('start_date_company', isset($student_statu) && $student_statu->start_date_company ? Carbon::parse($student_statu->start_date_company)->format('Y-m-d') : '') }}"/>
                <x-form.input type="date" name_label="Date de fin en entreprise" name="end_date_company" value="{{ old('end_date_company', isset($student_statu) && $student_statu->end_date_company ? Carbon::parse($student_statu->end_date_company)->format('Y-m-d') : '') }}"/>

                <div class="flex space-x-7">
                    <p class="flex bg-seventh-color px-6 py-2 rounded-lg mt-4 w-fit cursor-pointer" @click="step--"><x-heroicon-c-arrow-long-left class="w-6 h-auto" /> Précédent</p>
                    <p class="flex bg-seventh-color px-6 py-2 rounded-lg mt-4 w-fit cursor-pointer" @click="step++">Suivant <x-heroicon-c-arrow-long-right class="w-6 h-auto" /></p>
                </div>
            </div>

            <div x-show="step === 4" class="step">
                <h2>Informations sur la visite éffectué</h2>
                <div class="flex">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Statut de la visite :</label>
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input type="radio" name="visit_statu" value="oui" {{ old('visit_statu', isset($visit) ? strtolower($visit->visit_statu) : '') == 'oui' ? 'checked' : '' }}
                                class="form-radio">
                                <span class="ml-2">Oui</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input type="radio" name="visit_statu" value="non" {{ old('visit_statu', isset($visit) ? strtolower($visit->visit_statu) : '') == 'non' ? 'checked' : '' }}
                                class="form-radio">
                                <span class="ml-2">Non</span>
                            </label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="note" class="block text-sm font-medium text-gray-700">Notes :</label>
                        <textarea name="note" id="note" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('note') }}</textarea>
                    </div>
                    <x-form.input type="datetime-local" name_label="Date de début de la visite" name="start_date_visit" value="{{ old('start_date_visit', isset($visit) && $visit->start_date_visit ? Carbon::parse($visit->start_date_visit)->format('Y-m-d H:i:s') : '') }}"/>
                    <x-form.input type="datetime-local" name_label="Date de fin de la visite" name="end_date_visit" value="{{ old('end_date_visit', isset($visit) && $visit->end_date_visit ? Carbon::parse($visit->end_date_visit)->format('Y-m-d H:i:s') : '') }}"/>
                </div>
                <p class="flex bg-seventh-color px-6 py-2 rounded-lg mt-4 w-fit cursor-pointer" @click="step--"><x-heroicon-c-arrow-long-left class="w-6 h-auto" /> Précédent</p>
                <x-form.button name="Modifier"/>
            </div>

        </form>
    </div>
</x-layout>

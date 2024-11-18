<x-layout title="Mes étudiants">
    <div x-data="{ showBut : 'but2' }" class="mt-6">
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

        <div x-show="showBut === 'but2'">
            <h2>Étudiants en MMI2</h2>
            @if($studentsMMI2->isEmpty())
                <p>Aucun étudiant trouvé</p>
            @else
                @foreach ($studentsMMI2 as $student)
                    <p>{{ $student->firstname }} {{ $student->lastname }}</p>
                    <p>{{$student->last_visit->year_training->training_title}}</p>
                    @if ($student->last_visit->company)
                        <p>{{$student->last_visit->company->company_name}}</p>
                    @else
                        <p>Aucune entreprise associée à cette visite.</p>
                    @endif                    @if ($student->last_visit)
                        <a
                            class="bg-green-500 text-white px-4 py-2 rounded-lg mt-2"
                            href="{{ route('visit.edit', $student->last_visit->id) }}">
                            Programmer une visite
                        </a>
                    @endif
                @endforeach
            @endif
        </div>

        <div x-show="showBut === 'but3'" class="flex flex-col space-y-2 w-full">
            <h2>Étudiants en MMI3</h2>
            @if($studentsMMI3->isEmpty())
                <p>Aucun étudiant trouvé</p>
            @else
                @foreach ($studentsMMI3 as $student)
                    <p>{{ $student->firstname }} {{ $student->lastname }}</p>
                    @if ($student->last_visit)
                        <a
                            class="bg-green-500 text-white px-4 py-2 rounded-lg mt-2"
                            href="{{ route('visit.edit', $student->last_visit->id) }}">
                            Programmer une visite
                        </a>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</x-layout>

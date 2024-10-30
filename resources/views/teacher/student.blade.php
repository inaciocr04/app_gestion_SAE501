<x-layout title="Mes étudiants">
    <div x-data="{ showBut : 'but3' }" class="mt-6">

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
        <div x-show="showBut === 'but2'" class="">
                <h2>Étudiants en MMI2</h2>
            @foreach ($studentsMMI2 as $student)
                <p>{{ $student->firstname }} {{ $student->lastname }}</p>

                @if ($student->last_visit->start_date_visit)
                    <p>Date de visite : {{ $student->last_visit->start_date_visit }} - {{ $student->last_visit->end_date_visit }}</p>
                    <a
                        class="bg-blue-500 text-white px-4 py-2 rounded-lg mt-2"
                        href="">
                        Modifier la visite
                    </a>
                @else
                    <!-- Afficher bouton pour programmer une visite -->
                    <a
                        class="bg-green-500 text-white px-4 py-2 rounded-lg mt-2"
                        href="{{route('visit.create', ['studentId' => $student->id])}}">
                        Programmer une visite
                    </a>
                @endif
            @endforeach
        </div>
        <div x-show="showBut === 'but3'" class=" flex flex-col space-y-2 w-full">
                <h2>Étudiants en MMI3</h2>
            @foreach ($studentsMMI3 as $student)
                <p>{{ $student->firstname }} {{ $student->lastname }}</p>
                <p>Date de visit : {{ $student->last_visit->start_date_visit }} - {{ $student->last_visit->end_date_visit }}</p>            @endforeach
        </div>
    </div>
</x-layout>

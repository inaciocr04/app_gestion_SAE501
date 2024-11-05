<x-layout title="Les groupes">
    <div class="flex-1 flex justify-center items-center flex-col space-y-7">
        <h3 class="text-2xl">Les différents groupes</h3>
        <ul class="flex items-center space-x-7">
            <li class="bg-secondary-color px-8 py-8 rounded-xl">
                <a href="{{ route('tp_group.index') }}" class="text-lgdd text-white">
                    Groupes de TP <span class="text-sixth-color text-xs">({{ $tpCount }})</span>
                </a>

            </li>
            <li class="bg-secondary-color px-8 py-8 rounded-xl">
                <a href="{{ route('td_group.index') }}" class="text-lgdd text-white">
                    Groupes de TD <span class="text-sixth-color text-xs">({{ $tdCount }})</span>
                </a>

            </li>
        </ul>
        <h3 class="text-2xl">Les différentes années</h3>
        <ul class="flex items-center space-x-7">
            <li class="bg-secondary-color px-8 py-8 rounded-xl">
                <a href="{{ route('year_training.index') }}" class="text-lgdd text-white">
                    Années de formation <span class="text-sixth-color text-xs">({{ $yearTrainingCount }})</span>
                </a>

            </li>
            <li class="bg-secondary-color px-8 py-8 rounded-xl">
                <a href="{{ route('actual_year.index') }}" class="text-lg text-white">
                    Années scolaire <span class="text-sixth-color text-xs">({{ $actualYearCount }})</span>
                </a>
            </li>
        </ul>
    </div>
</x-layout>

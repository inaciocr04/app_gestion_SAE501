<x-layout title="Les groupes">
    <ul>
        <li>
            <a href="{{ route('tp_group.index') }}">
                Groupes de TP
            </a>
            ({{ $tpCount }})
        </li>
        <li>
            <a href="{{ route('td_group.index') }}">
                Groupes de TD
            </a>
            ({{ $tdCount }})
        </li>
        <li>
            <a href="{{ route('year_training.index') }}">
                Années de formation
            </a>
            ({{ $yearTrainingCount }})
        </li>
        <li>
            <a href="{{ route('actual_year.index') }}">
                Années scolaire
            </a>
            ({{ $actualYearCount }})
        </li>
    </ul>
</x-layout>

<x-layout title="Les groupes">
    <ul>
        <li>
            <a href="{{ route('manager.tp_group.index') }}">
                Groupes de TP
            </a>
            ({{ $tpCount }})
        </li>
        <li>
            <a href="{{ route('manager.td_group.index') }}">
                Groupes de TD
            </a>
            ({{ $tdCount }})
        </li>
        <li>
            <a href="{{ route('manager.year_training.index') }}">
                Années de formation
            </a>
            ({{ $yearTrainingCount }})
        </li>
        <li>
            <a href="{{ route('manager.actual_year.index') }}">
                Années scolaire
            </a>
            ({{ $actualYearCount }})
        </li>
    </ul>
</x-layout>

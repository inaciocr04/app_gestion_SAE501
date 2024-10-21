<x-layout title="Année scolaire">
    <a href="{{route('groupes.index')}}">Retour</a>
    <a href="{{route('actual_year.create')}}">Créer une année</a>
    <ul>
    @foreach($actual_years as $actual_year)
        <li>{{$actual_year->year_title}}
            <a href="{{route('actual_year.edit', ['actual_year' => $actual_year])}}">Modifier</a>
            <form action="{{route('actual_year.destroy', ['actual_year' => $actual_year])}}" method="POST">
                @csrf
                @method('DELETE')
                <button>Supprimer</button>
            </form>
        </li>
    @endforeach
    </ul>
</x-layout>

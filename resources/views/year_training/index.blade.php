<x-layout title="Année de formation">
    <a href="{{route('groupes.index')}}">Retour</a>
    <a href="{{route('year_training.create')}}">Créer une année de formation</a>
    <ul>
        @foreach($year_trainings as $year_training)
            <li>{{$year_training->training_title}}
                <a href="{{route('year_training.edit', ['year_training' => $year_training])}}">Modifier</a>
                <form action="{{route('year_training.destroy', ['year_training' => $year_training])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button>Supprimer</button>
                </form>
            </li>
        @endforeach
    </ul>
</x-layout>

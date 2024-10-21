<x-layout title="Groupes TD">
    <a href="{{route('groupes.index')}}">Retour</a>
    <a href="{{route('td_group.create')}}">Créer un groupe TD</a>
    <ul>
        @foreach($td_groups as $td_group)
            <li>{{$td_group->td_name}}
                <a href="{{route('td_group.edit', ['td_group' => $td_group])}}">Modifier</a>
                <form action="{{route('td_group.destroy', ['td_group' => $td_group])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button>Supprimer</button>
                </form>
            </li>
        @endforeach
    </ul>
</x-layout>

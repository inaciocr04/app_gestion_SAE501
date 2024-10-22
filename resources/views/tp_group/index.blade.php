<x-layout title="Groupes TP">
    <a href="{{route('groupes.index')}}">Retour</a>
    <a href="{{route('tp_group.create')}}">Créer un groupe TP</a>
    <ul>
    @foreach($tp_groups as $tp_group)
        <li>{{$tp_group->tp_name}}
            <a href="{{route('tp_group.edit', ['tp_group' => $tp_group])}}">Modifier</a>
            <form action="{{route('tp_group.destroy', ['tp_group' => $tp_group])}}" method="POST">
                @csrf
                @method('DELETE')
                <button>Supprimer</button>
            </form>
        </li>
    @endforeach
    </ul>
</x-layout>

<x-layout title="Groupes TP">
    <div class="flex space-x-2">
        <x-link.back href="{{route('manager.groupes.index')}}"/>
        <x-link.link name="Créer un groupe TP" href="{{route('manager.tp_group.create')}}"/>
    </div>
    <ul class="flex flex-col space-y-7">
        @foreach($tp_groups as $tp_group)
            <li class="flex justify-between items-center">
                {{$tp_group->tp_name}}
                <div class="flex space-x-7">
                    <x-link.link name="Modifier" href="{{route('manager.tp_group.edit', ['tp_group' => $tp_group])}}"/>
                    <form action="{{route('manager.tp_group.destroy', ['tp_group' => $tp_group])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-form.button name="Supprimer" class="bg-red-600"/>
                    </form>
                </div>
            </li>
      @endforeach
    </ul>
</x-layout>

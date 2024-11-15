<x-layout title="Groupes TP">
    <div class="flex space-x-2">
        <x-link.back href="{{route('groupes.index')}}"/>
        <x-link.link name="Créer un groupe TP" href="{{route('tp_group.create')}}"/>
    </div>
    <ul class="flex flex-col mt-4 bg-sixth-color">
        @foreach($tp_groups as $tp_group)
            <li class="flex justify-between items-center border-t border-black  px-6 py-4">
                {{$tp_group->tp_name}}
                <div class="flex space-x-7">
                    <x-link.link name="Modifier" href="{{route('tp_group.edit', ['tp_group' => $tp_group])}}"/>
                    <form action="{{route('tp_group.destroy', ['tp_group' => $tp_group])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-form.button name="Supprimer" class="bg-red-600"/>
                    </form>
                </div>
            </li>
      @endforeach
    </ul>
</x-layout>

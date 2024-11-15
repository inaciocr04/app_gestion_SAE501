<x-layout title="Groupes TD">
    <div class="flex space-x-2">
        <x-link.back href="{{route('groupes.index')}}"/>
        <x-link.link name="Créer un groupe TD" href="{{route('td_group.create')}}"/>
    </div>
    <ul class="flex flex-col mt-4 bg-sixth-color">
        @foreach($td_groups as $td_group)
            <li class="flex justify-between items-center border-t border-black  px-6 py-4">
                {{$td_group->td_name}}
                <div class="flex space-x-7">
                    <x-link.link name="Modifier" href="{{route('td_group.edit', ['td_group' => $td_group])}}"/>

                    <form action="{{route('td_group.destroy', ['td_group' => $td_group])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-form.button name="Supprimer" class="bg-red-600"/>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</x-layout>

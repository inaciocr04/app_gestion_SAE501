<x-layout title="Modification du tp {{$tp_group->tp_name}}">
    <x-link.back href="{{route('manager.tp_group.index')}}"/>
    <div class="flex flex-col justify-center items-center">
        <form action="{{route('manager.tp_group.update', ['tp_group' => $tp_group])}}" method="POST" class="flex space-x-7 items-end mb-1">
            @method('PUT')
            @csrf
            <x-form.input name_label="Nom du TP" name="tp_name" :value="$tp_group->tp_name"/>
            <x-form.button name="Modifier"/>
        </form>
    </div>
</x-layout>

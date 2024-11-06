<x-layout title="Modification du tp {{$tp_group->tp_name}}">
    <x-link.back href="{{route('manager.tp_group.index')}}"/>

    <form action="{{route('manager.tp_group.store', ['tp_group' => $tp_group])}}" method="POST">
        @method('POST')
        @csrf
        <x-form.input name_label="Nom du TP" name="tp_name" :value="$tp_group->tp_name"/>
        <x-form.button name="Créer"/>
    </form>
</x-layout>

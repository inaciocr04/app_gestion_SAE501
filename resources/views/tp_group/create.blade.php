<x-layout title="Modification du tp {{$tp_group->tp_name}}">
    <form action="{{route('tp_group.store', ['tp_group' => $tp_group])}}" method="POST">
        @method('POST')
        @csrf
        <x-form.input name_label="Nom du TP" name="tp_name" :value="$tp_group->tp_name"/>
        <button>Créer</button>
    </form>
</x-layout>

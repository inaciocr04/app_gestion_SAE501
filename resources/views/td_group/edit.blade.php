<x-layout title="Modification du td {{$td_group->td_name}}">
    <x-link.back href="{{route('td_group.index')}}"/>

    <form action="{{route('td_group.update', ['td_group' => $td_group])}}" method="POST">
        @method('PUT')
        @csrf
        <x-form.input name_label="Nom du TP" name="td_name" :value="$td_group->td_name"/>
        <x-form.button name="Modifier"/>
    </form>
</x-layout>

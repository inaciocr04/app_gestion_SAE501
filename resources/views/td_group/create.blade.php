<x-layout title="Modification du td {{$td_group->td_name}}">
    <form action="{{route('td_group.store', ['td_group' => $td_group])}}" method="POST">
        @method('POST')
        @csrf
        <x-form.input name_label="Nom du td" name="td_name" :value="$td_group->td_name"/>
        <button>Créer</button>
    </form>
</x-layout>

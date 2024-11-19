<x-layout title="Modification du td {{$td_group->td_name}}">
    <x-link.back href="{{route('manager.td_group.index')}}"/>
    <div class="flex flex-col justify-center items-center">
        <form action="{{route('manager.td_group.store', ['td_group' => $td_group])}}" method="POST" class="flex space-x-7 items-end mb-1">
            @method('POST')
            @csrf
            <x-form.input name_label="Nom du td" name="td_name" :value="$td_group->td_name"/>
            <x-form.button name="Créer"/>
        </form>
    </div>
</x-layout>

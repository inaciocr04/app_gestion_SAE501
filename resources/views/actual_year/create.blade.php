<x-layout title="Modification de l'année actuel {{$actual_year->year_title}}">
    <x-link.back href="{{route('actual_year.index')}}"/>

    <form action="{{route('actual_year.store', ['atual_year' => $actual_year])}}" method="POST">
        @method('POST')
        @csrf
        <x-form.input name_label="Année" name="year_title" :value="$actual_year->year_title"/>
        <x-form.button name="Créer"/>
    </form>
</x-layout>

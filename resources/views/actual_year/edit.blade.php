<x-layout title="Modification de l'année {{$actual_year->year_title}}">
    <x-link.back href="{{route('actual_year.index')}}"/>

    <form action="{{route('actual_year.update', ['actual_year' => $actual_year])}}" method="POST">
        @method('PUT')
        @csrf
        <x-form.input name_label="Année scolaire" name="year_title" :value="$actual_year->year_title"/>
        <x-form.button name="Modifier"/>
    </form>
</x-layout>

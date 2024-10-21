<x-layout title="Modification de l'année {{$actual_year->year_title}}">
    <form action="{{route('actual_year.update', ['actual_year' => $actual_year])}}" method="POST">
        @method('PUT')
        @csrf
        <x-form.input name_label="Année scolaire" name="year_title" :value="$actual_year->year_title"/>
        <button>Modifier</button>
    </form>
</x-layout>

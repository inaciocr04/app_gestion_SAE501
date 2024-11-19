<x-layout title="Modification de l'année {{$actual_year->year_title}}">
    <x-link.back href="{{route('manager.actual_year.index')}}"/>
    <div class="flex flex-col justify-center items-center">
        <form action="{{route('manager.actual_year.update', ['actual_year' => $actual_year])}}" method="POST" class="flex space-x-7 items-end mb-1">
            @method('PUT')
            @csrf
            <x-form.input name_label="Année scolaire" name="year_title" :value="$actual_year->year_title"/>
            <x-form.button name="Modifier"/>
        </form>
    </div>
</x-layout>

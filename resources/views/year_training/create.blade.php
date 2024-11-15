<x-layout title="Modification de l'année de formation {{$year_training->training_title}}">
    <x-link.back href="{{route('year_training.index')}}"/>

    <form action="{{route('year_training.store', ['year_training' => $year_training])}}" method="POST">
        @method('POST')
        @csrf
        <x-form.input  name_label="Année de formation" name="training_title" :value="$year_training->training_title"/>
        <x-form.button name="Créer"/>
    </form>
</x-layout>

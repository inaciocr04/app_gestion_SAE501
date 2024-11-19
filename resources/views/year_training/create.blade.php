<x-layout title="Modification de l'année de formation {{$year_training->training_title}}">
    <x-link.back href="{{route('manager.year_training.index')}}"/>
    <div class="flex flex-col justify-center items-center">
        <form action="{{route('manager.year_training.store', ['year_training' => $year_training])}}" method="POST" class="flex space-x-7 items-end mb-1">
            @method('POST')
            @csrf
            <x-form.input  name_label="Année de formation" name="training_title" :value="$year_training->training_title"/>
            <x-form.button name="Créer"/>
        </form>
    </div>
</x-layout>

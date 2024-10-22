<x-layout title="Modification de l'année {{$year_training->training_title}}">
    <form action="{{route('year_training.update', ['year_training' => $year_training])}}" method="POST">
        @method('PUT')
        @csrf
        <x-form.input name_label="Année de formation" name="training_title" :value="$year_training->training_title"/>
        <button>Modifier</button>
    </form>
</x-layout>

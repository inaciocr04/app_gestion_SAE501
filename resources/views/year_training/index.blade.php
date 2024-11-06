<x-layout title="Année de formation">
    <div class="flex space-x-2">
        <x-link.back href="{{route('manager.groupes.index')}}"/>
        <x-link.link name="Créer une année de formation" href="{{route('manager.year_training.create')}}"/>
    </div>
    <ul class="flex flex-col space-y-7">
        @foreach($year_trainings as $year_training)
            <li class="flex justify-between items-center">
                {{$year_training->training_title}}
                <div class="flex space-x-7">
                    <x-link.link name="Modifier" href="{{route('manager.year_training.edit', ['year_training' => $year_training])}}"/>

                    <form action="{{route('manager.year_training.destroy', ['year_training' => $year_training])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-form.button name="Supprimer" class="bg-red-600"/>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</x-layout>

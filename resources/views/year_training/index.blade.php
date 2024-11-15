<x-layout title="Année de formation">
    <div class="flex space-x-2">
        <x-link.back href="{{route('groupes.index')}}"/>
        <x-link.link name="Créer une année de formation" href="{{route('year_training.create')}}"/>
    </div>
    <ul class="flex flex-col mt-4 bg-sixth-color">
        @foreach($year_trainings as $year_training)
            <li class="flex justify-between items-center border-t border-black  px-6 py-4">
                {{$year_training->training_title}}
                <div class="flex space-x-7">
                    <x-link.link name="Modifier" href="{{route('year_training.edit', ['year_training' => $year_training])}}"/>

                    <form action="{{route('year_training.destroy', ['year_training' => $year_training])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-form.button name="Supprimer" class="bg-red-600"/>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</x-layout>

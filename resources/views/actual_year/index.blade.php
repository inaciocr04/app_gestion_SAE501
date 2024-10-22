<x-layout title="Année scolaire">
    <div class="flex space-x-2">
        <x-link.back href="{{route('groupes.index')}}"/>
        <x-link.link name="Créer une année" href="{{route('actual_year.create')}}"/>
    </div>
    <ul class="flex flex-col space-y-7">
        @foreach($actual_years as $actual_year)
            <li class="flex justify-between items-center">
                {{$actual_year->year_title}}
                <div class="flex space-x-7">
                    <x-link.link name="Modifier" href="{{route('actual_year.edit', ['actual_year' => $actual_year])}}"/>
                    <form action="{{route('actual_year.destroy', ['actual_year' => $actual_year])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-form.button name="Supprimer" class="bg-red-600"/>
                    </form>
                </div>
            </li>
      @endforeach
    </ul>
</x-layout>

<x-layout title="Modifier le enseignant">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <x-link.back href="{{ route('manager.teachers') }}"/>
    <div class="flex flex-col justify-center items-center">
        <form action="{{ route('manager.teacher.update', $teacher->id) }}" method="POST" class="flex flex-col space-y-7">
            @csrf
            @method('PUT')

            <div class="flex flex-col space-y-7">
                <x-form.input name_label="Nom" name="lastname" :value="$teacher->lastname" required/>
                <x-form.input name_label="Prénom" name="firstname" :value="$teacher->firstname"/>
                <x-form.input name_label="Adresse email" name="unistra_email" :value="$teacher->unistra_email"/>
            </div>

            <x-form.button name="Mettre à jour"/>
        </form>
    </div>
</x-layout>

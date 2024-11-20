<x-layout title="Créer un enseignant">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <x-link.back href="{{route('manager.teachers')}}"/>
        <div class="flex flex-col justify-center items-center">
            <form action="{{ route('manager.teacher.store') }}" method="POST" class="flex flex-col space-y-7">
                @csrf
                <div class="flex flex-col space-y-7">
                    <x-form.input name_label="Nom" name="lastname"/>
                    <x-form.input name_label="Prénom" name="firstname"/>
                    <x-form.input name_label="Adresse email" name="unistra_email"/>
                </div>

                <x-form.button name="Créer"/>
            </form>
        </div>
</x-layout>

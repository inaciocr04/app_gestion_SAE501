<x-layout title="Mon compte">
    @if(Auth::user()->isStudent())
        <h1 class="text-black">Bienvenue {{ Auth::user()->name }} sur la page d'accueil</h1>
        <p>vous êtes authentifiez en tant qu'étudiant</p>
    @elseif(Auth::user()->isTeacher())
        <h1 class="text-black">Bienvenue {{ Auth::user()->name }} sur la page d'accueil</h1>
        <p>vous êtes authentifiez en tant qu'enseignant</p>
    @elseif(Auth::user()->isManager())
        <h1 class="text-black">Bienvenue {{ Auth::user()->name }} sur la page d'accueil</h1>
        <p>vous êtes authentifiez en tant que gestionnaire</p>
    @endif
</x-layout>

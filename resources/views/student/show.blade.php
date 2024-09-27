<x-layout title="Mes informations">
    @if($student)
        <p>Nom: {{$student->lastname}}</p>
        <p>Prénom: {{$student->firstname}}</p>
        <p>Date: {{$student->date_birth}}</p>
        <p>N°étudiant: {{$student->student_number}}</p>
        <p>N°téléphone: {{$student->telephone_number}}</p>
        <p>Email personnel: {{$student->personal_email}}</p>
        <p>Email Unistra: {{$student->unistra_email}}</p>
        <p>Adresse domicile: {{$student->address}}</p>
        <p>Code postal: {{$student->postcode}}</p>
        <p>Ville: {{$student->city}}</p>
        @if($student->permanent_telephone_number)
            <p>{{$student->permanent_telephone_number}}</p>
            <p>{{$student->permanent_address}}</p>
            <p>{{$student->permanent_postcode}}</p>
            <p>{{$student->permanent_city}}</p>
        @endif

    @else
        <p>Aller voir un gestionnaire ou vérifier votre adresse email unistra si elle est correcte car vous êtes associer a aucun étudiants</p>
    @endif
</x-layout>

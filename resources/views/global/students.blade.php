<x-layout title="Tous les étudiants">
    <div x-data="{ showBut : 'but1' }">
        <div class="flex space-x-28">
            <div @click="showBut = 'but1'" :class="{'bg-blue-500 text-white': showBut === 'but1', 'bg-gray-200 text-black': showBut !== 'but1'}"
                 class="px-4 py-2 rounded">
                <p>Etudiant BUT1</p>
            </div>
            <div @click="showBut = 'but2'" :class="{'bg-blue-500 text-white': showBut === 'but2', 'bg-gray-200 text-black': showBut !== 'but2'}"
                 class="px-4 py-2 rounded">
                <p>Etudiant BUT2</p>
            </div>
            <div @click="showBut = 'but3'" :class="{'bg-blue-500 text-white': showBut === 'but3', 'bg-gray-200 text-black': showBut !== 'but3'}"
                 class="px-4 py-2 rounded">
                <p>Etudiant BUT3</p>
            </div>
        </div>
        <table x-show="showBut === 'but1'">
            <thead>
            <th>N°étudiant</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Formation Actuelle</th>
            <th>Parcours</th>
            <th>Date de début</th>
            </thead>
            <tbody>
            @foreach($studentsMMI1 as $student)
                <tr>
                    <!--<td>{{$student->student_number}}</td>-->
                    <td>{{$student->firstname}}</td>
                    <td>{{$student->lastname}}</td>
                    <td>{{$student->trainings->last()->year_training->training_title}}</td>
                    <td>{{$student->courses->last()->training_course->course_title}}</td>
                    <td>{{$student->courses->last()->start_date}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <table x-show="showBut === 'but2'">
            <thead>
            <th>N°étudiant</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Formation Actuelle</th>
            <th>Parcours</th>
            <th>Date de début</th>
            </thead>
            <tbody>
            @foreach($studentsMMI2 as $student)
                <tr>
                    <td>{{$student->student_number}}</td>
                    <td>{{$student->firstname}}</td>
                    <!--<td>{{$student->lastname}}</td>-->
                    <td>{{$student->trainings->last()->year_training->training_title}}</td>
                    <td>{{$student->courses->last()->training_course->course_title}}</td>
                    <td>{{$student->courses->last()->start_date}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <table x-show="showBut === 'but3'">
            <thead>
                <th>N°étudiant</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Formation Actuelle</th>
                <th>Parcours</th>
                <th>Date de début</th>
                </thead>
            <tbody>
            @foreach($studentsMMI3 as $student)
                <tr>
                    <td>{{$student->student_number}}</td>
                    <td>{{$student->firstname}}</td>
                    <td>{{$student->lastname}}</td>
                    <td>{{$student->trainings->last()->year_training->training_title}}</td>
                    <td>{{$student->courses->last()->training_course->course_title}}</td>
                    <td>{{$student->courses->last()->start_date}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-layout>

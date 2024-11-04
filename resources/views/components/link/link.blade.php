@props([
    'name',
    'href' => '',
    'class' => '',
])
<a class="bg-secondary-color text-white rounded-lg px-4 py-2 w-fit {{$class}}" href="{{$href}}">{{$name}}</a>

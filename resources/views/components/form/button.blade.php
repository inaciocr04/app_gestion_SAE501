@props([
    'name',
    'type' => '',
    'class' => '',
])
<button class="bg-secondary-color text-white rounded-lg px-4 py-2 {{$class}}" type="{{$type}}">{{$name}}</button>

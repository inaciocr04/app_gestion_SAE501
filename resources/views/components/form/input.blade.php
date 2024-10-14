@props([
    'name',
    'name_label',
    'type' => 'test',
    'value' => '',
    'class' => 'form-input w-full',
    ])
    <label for="{{$name}}">
        {{$name_label}}
        <input type="{{$type}}" name="{{$name}}" value="{{old($name, $value)}}" class="{{$class}}">
        @error($name)
        <span style="display: block; color: red;">{{$message}}</span>
        @enderror
    </label>

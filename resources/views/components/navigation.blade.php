@props([
    'route',
    'route_params' => null,
    'name_link',
    'icon' => '',
])
<ul class="space-y-7">
     <li class="{{ Route::is($route) ? 'py-3.5 pl-3.5 flex space-x-7 bg-seventh-color text-black' : 'pl-3.5 flex space-x-7' }}">
            <a href="{{ Route($route, $route_params) }}" class="flex space-x-7 w-full items-center">
                    {!!$icon !!}
                <span>{{$name_link}}</span>
            </a>
        </li>
</ul>

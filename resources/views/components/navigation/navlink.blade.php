<li>
    <a href="{{ route($route) }}" wire:navigate.hover
        class="navlink p-4 block @if(\Illuminate\Support\Facades\Route::currentRouteName() == $route)active @endif"
    >{{ $name }}</a>
</li>
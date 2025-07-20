<li>
    <a @click.stop="console.log('Navlink clicked'); $store.navOpen = false; setTimeout(() => Livewire.navigate('{{ route($route) }}'), 10)" href="{{ route($route) }}"
        class="navlink p-4 block md:hidden @if(\Illuminate\Support\Facades\Route::currentRouteName() == $route)active @endif"
    >{{ $name }}</a>
    <a href="{{ route($route) }}" wire:navigate.hover
        class="navlink p-4 hidden md:block @if(\Illuminate\Support\Facades\Route::currentRouteName() == $route)active @endif"
    >{{ $name }}</a>
</li>
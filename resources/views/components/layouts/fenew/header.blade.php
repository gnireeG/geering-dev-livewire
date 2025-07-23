{{-- Header BG Desktop --}}
<div class="flex justify-center bg-bg-light w-full py-4 z-30" aria-hidden>
    <div class="container flex justify-between items-center">
        <div>
            <a href="{{route('home')}}" wire:navigate><img src="{{ asset('logo-geering-dev-dark.png') }}" alt="Logo geering.dev" class="w-30 md:w-48" id="logo-dark"></a>
            <a href="{{route('home')}}" wire:navigate><img src="{{ asset('logo-geering-dev-light.png') }}" alt="Logo geering.dev" class="w-30 md:w-48" id="logo-light"></a>
        </div>
    </div>
</div>
{{-- Header Desktop --}}
<header class="hidden md:flex justify-center w-full fixed top-0 z-30 hover:bg-bg-light py-4 group transition-colors">
    <nav class="container flex justify-between items-center">
        <div class="opacity-0 group-hover:opacity-100 transition-opacity">
            <a href="{{route('home')}}" wire:navigate><img src="{{ asset('logo-geering-dev-dark.png') }}" alt="Logo geering.dev" class="w-48" id="logo-dark"></a>
            <a href="{{route('home')}}" wire:navigate><img src="{{ asset('logo-geering-dev-light.png') }}" alt="Logo geering.dev" class="w-48" id="logo-light"></a>
        </div>
        <div class="flex gap-2 items-center justify-end">
            <x-layouts.fenew.navigation class="flex" />
            <x-language-switcher variant="dropdown" />
        </div>
    </nav>
</header>
{{-- Mobile Navigation Toggle --}}
<div class="md:hidden fixed top-3 right-2 z-30 -translate-y-0.5">
    <button @click="$store.nav.toggle()" class="p-2 cursor-pointer active:ring-2 rounded-lg visited:ring-2">
        <flux:icon.bars-3-bottom-left class="size-8" x-show="!$store.nav.open" />
        <flux:icon.bars-3-bottom-right class="size-8" x-show="$store.nav.open" x-cloak />
    </button>
</div>
{{-- Mobile Navigation --}}
<header class="md:hidden fixed top-0 left-0 w-full h-screen z-20 flex justify-center items-center transition-transform duration-500 mobile-nav"
:class="$store.nav.open ? 'open' : ''">
    <nav class="flex flex-col items-center gap-4 h-full justify-between py-32">
        <div>
            <a href="{{route('home')}}" wire:navigate x-show="showLogoInMobileNav"><img src="{{ asset('logo-geering-dev-dark.png') }}" alt="Logo geering.dev" class="w-30 md:w-48" id="logo-dark"></a>
            <a href="{{route('home')}}" wire:navigate x-show="showLogoInMobileNav"><img src="{{ asset('logo-geering-dev-light.png') }}" alt="Logo geering.dev" class="w-30 md:w-48" id="logo-light"></a>
        </div>
        <x-layouts.fenew.navigation class="flex flex-col items-center gap-4" />
        <x-language-switcher variant="inline-words" class="text-sm" />
    </nav>
</header>
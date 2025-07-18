<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="{{ session('theme', 'light') }} min-h-[100vh] overflow-x-hidden"
    data-session-theme="{{session('theme') ? "true" : "false"}}"
    data-theme="{{ session('theme', 'light') }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ? $title.' - geering.dev' : config('app.name') }}</title>

    <meta name="description" content="{{ $description ?? 'Webseite von Joel Geering' }}">

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

</head>
<body class="bg-bg text-accent flex flex-col min-h-[100vh] relative">
    <div class="flex justify-center bg-bg-light/80 w-full py-4 z-30 backdrop-blur">
        {{-- <x-navigation.navigation /> --}}
        <div class="container flex justify-between items-center">
            <div>
                <a href="{{route('home')}}" wire:navigate><img src="{{ asset('logo-geering-dev-dark.png') }}" alt="Logo geering.dev" class="w-48" id="logo-dark"></a>
                <a href="{{route('home')}}" wire:navigate><img src="{{ asset('logo-geering-dev-light.png') }}" alt="Logo geering.dev" class="w-48" id="logo-light"></a>
            </div>
        </div>
    </div>
    <div class="flex justify-center w-full fixed top-0 z-30 hover:backdrop-blur py-4 group transition-colors">
        <div class="container flex justify-between items-center">
            <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                <a href="{{route('home')}}" wire:navigate><img src="{{ asset('logo-geering-dev-dark.png') }}" alt="Logo geering.dev" class="w-48" id="logo-dark"></a>
                <a href="{{route('home')}}" wire:navigate><img src="{{ asset('logo-geering-dev-light.png') }}" alt="Logo geering.dev" class="w-48" id="logo-light"></a>
            </div>
            <nav class="flex gap-2 items-center justify-end">
                <ul class="flex">
                    <livewire:Navigation.Navlink route="home" name="Home" />
                    <livewire:Navigation.Navlink route="about" name="About" />
                    <livewire:Navigation.Navlink route="portfolio" name="Portfolio" />
                    <livewire:Navigation.Navlink route="contact" name="Contact" />
                </ul>
                <x-language-switcher variant="dropdown" />
            </nav>
        </div>
    </div>
    <main class="grow py-4 md:py-8 lg:py-12 overflow-x-hidden">
        {{ $slot }}
    </main>
    <footer class="flex justify-center bg-bg-light/80 p-2 md:p-4 lg:p-8">
        <div class="container">
            <div class="flex justify-between">
                <div>
                    <x-language-switcher />
                    <p class="text-sm text-muted mt-8">
                        &copy; {{ date('Y') }} Joel Geering (geering.dev)
                    </p>
                </div>
                <div>
                    <x-theme-toggle />
                </div>
            </div>
        </div>
    </footer>
    <div id="bg-gradient"></div>
    <div id="bg-pattern"></div>
    @fluxScripts
</body>
</html>
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
    <header class="flex justify-center bg-bg-light/80 sticky top-0 w-full py-4 z-30 backdrop-blur">
        <x-navigation.navigation />
    </header>
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
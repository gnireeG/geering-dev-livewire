<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="{{ session('theme', 'light') }} min-h-[100vh] overflow-x-hidden"
    data-session-theme="{{session('theme') ? "true" : "false"}}"
    data-theme="{{ session('theme', 'light') }}"
     x-data :class="$store.nav.open ? 'overflow-y-hidden' : ''">
<x-layouts.fenew.head :title="$title ?? 'geering.dev'" :description="$description ?? 'Webseite von Joel Geering'" />
<body class="bg-bg text-accent flex flex-col min-h-[100vh] relative"
x-data="{showLogoInMobileNav: false}"
x-init="window.addEventListener('scroll', () => {showLogoInMobileNav = window.scrollY > 68;});">
    <x-layouts.fenew.header />
    <main class="grow overflow-x-hidden transition-transform duration-500 {{isset($noPadding) && $noPadding ? '' : 'py-4 md:py-8 lg:py-12'}}" :class="$store.nav.open ? '-translate-x-[100vw]' : ''">
        {{ $slot }}
    </main>
    <x-layouts.fenew.footer />
    <div id="bg-gradient"></div>
    <div id="bg-pattern"></div>
    @fluxScripts
</body>
</html>
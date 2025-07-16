<nav class="container flex justify-between items-center">
    <div>
        <a href="{{route('home')}}" wire:navigate><img src="{{ asset('logo-geering-dev-dark.png') }}" alt="Logo geering.dev" class="w-48" id="logo-dark"></a>
        <a href="{{route('home')}}" wire:navigate><img src="{{ asset('logo-geering-dev-light.png') }}" alt="Logo geering.dev" class="w-48" id="logo-light"></a>
    </div>
    <ul class="flex">
        <livewire:Navigation.Navlink route="home" name="Home" />
        <livewire:Navigation.Navlink route="about" name="About" />
        <livewire:Navigation.Navlink route="portfolio" name="Portfolio" />
        <livewire:Navigation.Navlink route="contact" name="Contact" />
    </ul>
</nav>
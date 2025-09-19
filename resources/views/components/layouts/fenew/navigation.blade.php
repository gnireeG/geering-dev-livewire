<ul class="{{ $attributes['class'] }}">
    <livewire:Navigation.Navlink route="home" name="Home" />
    {{-- <livewire:Navigation.Navlink route="about" name="About" /> --}}
    <livewire:Navigation.Navlink route="portfolio" name="Portfolio" />
    <livewire:Navigation.Navlink route="contact" name="{{ __('general.contact') }}" />
</ul>
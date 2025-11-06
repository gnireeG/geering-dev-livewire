<ul class="{{ $attributes['class'] }}">
    <livewire:Navigation.Navlink route="home" name="Home" />
    {{-- <livewire:Navigation.Navlink route="about" name="About" /> --}}
    @if(\App\Models\Portfolio::count() > 0)<livewire:Navigation.Navlink route="portfolio" name="Portfolio" />@endif
    {{-- <livewire:Navigation.Navlink route="services" name="{{ __('general.services') }}" /> --}}
    <livewire:Navigation.Navlink route="contact" name="{{ __('general.contact') }}" />
</ul>
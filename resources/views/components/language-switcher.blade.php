<div>
    @if($attributes['variant'] == 'inline' || !$attributes->has('variant'))
        <div x-data="{open: false}" class="{{ $attributes['class'] }}">
            <div class="flex gap-2">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a wire:navigate rel="alternate" @if($localeCode == LaravelLocalization::getCurrentLocale()) class="font-bold" @endif hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" title="{{ $properties['native'] }}">
                        {{ $localeCode }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif
    @if($attributes['variant'] == 'inline-words')
        <div x-data="{open: false}" class="{{ $attributes['class'] }}">
            <div class="flex gap-4">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a wire:navigate rel="alternate" @if($localeCode == LaravelLocalization::getCurrentLocale()) class="font-bold" @endif hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" title="{{ $properties['native'] }}">
                        {{ Str::ucfirst($properties['native']) }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif
    @if($attributes['variant'] == 'dropdown')
        <div x-data="{switcherOpen: false}" class="{{ $attributes['class'] }} relative">
            <button @click="switcherOpen = !switcherOpen" class="flex items-center gap-1 cursor-pointer text-sm" title="{{ __('general.switch_language') }}">
                {{ LaravelLocalization::getCurrentLocale() }}
                {{-- <flux:icon.chevron-down x-show="!open" variant="mini" />
                <flux:icon.chevron-up x-show="open" variant="mini" /> --}}
                <flux:icon.globe-alt variant="mini" />
            </button>
            <div x-show="switcherOpen" x-cloak class="absolute z-50 p-2 -right-2 mt-1 bg-bg-light rounded-lg divide-accent/20 divide-y" x-transition>
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a wire:navigate.hover rel="alternate"
                    hreflang="{{ $localeCode }}"
                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                    title="{{ $properties['native'] }}"
                    class="block px-2 py-1 hover:text-primary {{ LaravelLocalization::getCurrentLocale() == $localeCode ? 'font-bold' : '' }}">
                        {{ Str::ucfirst($properties['native']) }}
                    </a>
                @endforeach
            </div>
            <div x-show="switcherOpen" x-cloak class="fixed w-screen h-screen inset-0 z-40" @click="switcherOpen = false"></div>
        </div>
    @endif
</div>

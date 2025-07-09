<div x-data="{open: false}" class="relative">
    {{-- <button @click="open = !open" class="p-2 bg-bg hover:bg-bg/60 rounded-tl-lg rounded-br-lg flex gap-2 cursor-pointer">
        {{ LaravelLocalization::getCurrentLocaleNative() }}
        <flux:icon.chevron-down class="size-6" x-show="!open" />
        <flux:icon.chevron-up class="size-6" x-show="open" />
    </button>
    <div x-show="open" class="absolute">
        <ul>
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            @if($localeCode !== LaravelLocalization::getCurrentLocale())
                <li>
                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
    </div> --}}

    <div class="flex gap-2">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <a rel="alternate" @if($localeCode == LaravelLocalization::getCurrentLocale()) class="font-bold" @endif hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" title="{{ $properties['native'] }}">
                {{ $localeCode }}
            </a>
        @endforeach
        </div>
    
</div>
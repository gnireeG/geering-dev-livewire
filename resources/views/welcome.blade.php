<x-layouts.fe>
    <main>
        <div class="flex justify-between">
            <div>
                <img src="{{ asset('logo-geering-dev-dark.png') }}" alt="Logo geering.dev" class="w-48" id="logo-dark">
                <img src="{{ asset('logo-geering-dev-light.png') }}" alt="Logo geering.dev" class="w-48" id="logo-light">
            </div>
            <div>
                <button class="theme-toggle cursor-pointer" id="theme-toggle" title="Toggles light & dark" aria-label="auto" aria-live="polite">
                <svg class="sun-and-moon" aria-hidden="true" width="24" height="24" viewBox="0 0 24 24">
                    <mask class="moon" id="moon-mask">
                    <rect x="0" y="0" width="100%" height="100%" fill="white" />
                    <circle cx="24" cy="10" r="6" fill="black" />
                    </mask>
                    <circle class="sun" cx="12" cy="12" r="6" mask="url(#moon-mask)" fill="currentColor" />
                    <g class="sun-beams" stroke="currentColor">
                    <line x1="12" y1="1" x2="12" y2="3" />
                    <line x1="12" y1="21" x2="12" y2="23" />
                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64" />
                    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78" />
                    <line x1="1" y1="12" x2="3" y2="12" />
                    <line x1="21" y1="12" x2="23" y2="12" />
                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36" />
                    <line x1="18.36" y1="5.64" x2="19.78" y2="4.22" />
                    </g>
                </svg>
                </button>
            </div>
        </div>
        <div class="sm:ml-12">
            <p>{!! __('home.intro') !!}</p>
            <div class="flex gap-8 mt-8 flex-col lg:flex-row">
                <div>
                    <h2>{{__('home.websites')}}</h2>
                    <p>{{__('home.websites_desc')}}</p>
                </div>
                <div>
                    <h2>{{__('home.webapps')}}</h2>
                    <p>{{__('home.webapps_desc')}}</p>
                </div>
            </div>
            <div class="flex justify-end w-full mt-16">
                <div class="flex flex-col items-end">
                    <div>
                        <h3>{{__('home.contact')}}</h3>
                        <p class="mb-4">{{__('home.contact_desc')}}</p>
                    </div>
                    <a class="btn" href="mailto:joel@geering.dev">joel@geering.dev</a>
                </div>
            </div>
            <div>
                <x-language-switcher></x-language-switcher>
            </div>
        </div>
    </main>
</x-layouts.fe>

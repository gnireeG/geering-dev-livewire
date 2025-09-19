<div>
    <section class="bg-bg-light">
        <div class="py-28 max-w-[1920px] mx-auto hidden md:block"
        style="background-image: url('{{ asset('images/bg-hero-website.png') }}'); background-repeat: no-repeat; background-position: right;"
        class="bg-no-repeat bg-right">
            <x-container>
                <div class="md:max-w-8/12">
                    <h1 class="mb-4"><span class="bg-bg-light">{!! __('home.heading') !!}</span></h1>
                    <p class="text-lg mb-8 max-w-2xl"><span class="bg-bg-light">{{ __('home.intro') }}</span></p>
                    <a href="{{ route('contact') }}" class="btn btn-outline" wire:navigate><flux:icon.chevron-right />{{ __('home.c2a_project') }}</a>
                </div>
            </x-container>
        </div>
        <x-container class="md:hidden py-12">
            <h1 class="mb-4">{!! __('home.heading') !!}</h1>
            <p class="text-lg mb-8 max-w-2xl">{!! __('home.intro') !!}</p>
            <a href="mailto:pascal@deinedomain.ch" class="btn btn-outline"><flux:icon.chevron-right />{{ __('home.c2a_project') }}</a>
        </x-container>
    </section>
    <x-container>
        <section class="py-28">
            <h2 class="mb-12 text-center">{{ __('home.what_i_do') }}</h2>
            <div class="flex justify-center max-w-4xl mx-auto">
                <div class="flex flex-col gap-12">
                    <div class="flex gap-4 bg-bg-light p-6 rounded-xl group">
                        <div class="grow">
                            <h3 class="text-xl font-bold mb-2">{{ __('home.websites') }}</h3>
                            <p>{{ __('home.websites_description') }}</p>
                            <x-action-link wire:navigate href="{{ route('about') }}" class="mt-4">{{ __('general.read_more') }}</x-action-link>
                        </div>
                        <div>
                            <img src="{{ asset('images/website.svg') }}" alt="{{ __('home.websites') }}" class="w-64 scale-150 origin-bottom-left transition-transform duration-500 group-hover:rotate-6" />
                        </div>
                    </div>
                    <div class="flex gap-4 bg-bg-light p-6 rounded-xl group">
                        <div>
                            <img src="{{ asset('images/webapp.svg') }}" alt="{{ __('home.webapps') }}" class="w-56 scale-150 origin-top-right transition-transform duration-500 group-hover:rotate-6" />
                        </div>
                        <div class="grow">
                            <h3 class="text-xl font-bold mb-2">{{ __('home.webapps') }}</h3>
                            <p>{{ __('home.webapps_description') }}</p>
                            <x-action-link wire:navigate href="{{ route('about') }}" class="mt-4">{{ __('general.read_more') }}</x-action-link>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x-container>
    @if(count($portfolios) > 0)
    <x-container>
        <section class="py-28">
            <h2 class="text-3xl font-semibold text-center mb-12">{{ __('home.projects') }}</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6" x-data="{ showTags: false }">
                @foreach($portfolios as $portfolio)
                    <x-portfolio.card :portfolio="$portfolio" />
                @endforeach
            </div>
            <div class="flex justify-center mt-10">
                <x-action-link wire:navigate href="{{ route('portfolio') }}" class="mt-4">{{ __('home.entire_portfolio') }}</x-action-link>
            </div>
        </section>
    </x-container>
    @endif
    <section class="py-28 bg-bg-light group">
        <x-container>
            <div class="sm:grid gap-12 grid-cols-12">
                <div class="hidden sm:block sm:col-span-4 lg:col-span-3">
                    <img src="{{ asset('images/mailbox.svg') }}" alt="Avatar" class="size-full group-hover:scale-110 transition-transform duration-300" />
                </div>
                <div class="sm:col-span-8 lg:col-span-9">
                    <h2 class="text-3xl font-semibold mb-4">{{ __('home.contact') }}</h2>
                    <p class="mb-6">{{ __('home.contact_description') }}</p>
                    <a wire:navigate href="{{ route('contact') }}" class="btn btn-outline"><flux:icon.chevron-right />{{ __('home.contact_me') }}</a>
                </div>
            </div>
        </x-container>
    </section>
</div>
<x-container class="bg-bg-light px-2 md:px-4 lg:px-8 py-16">
    <div class="grid grid-cols-4 sm:grid-cols-12 gap-8 sm:gap-4">
        <div class="col-span-4 flex justify-between">
            <x-action-link wire:navigate href="{{ route('contact') }}">{{ __('home.contact') }}</x-action-link>
            <x-theme-toggle class="sm:hidden" />
        </div>
        <div class="col-span-4 flex sm:justify-center">
            <x-language-switcher variant="inline-words" />
        </div>
        <div class="col-span-4 hidden sm:flex sm:justify-end items-start">
            <x-theme-toggle />
        </div>
    </div>
    <div class="text-sm text-muted mt-8 flex sm:justify-center gap-2 flex-wrap">
        <p>&copy; {{ date('Y') }} Joel Geering</p>
        <div class="flex gap-2 flex-wrap sm:justify-center">
            <a class="footer-link" wire:navigate href="#">{{ __('footer.privacy_policy') }}</a>
            <a class="footer-link" wire:navigate href="#">{{ __('footer.impressum') }}</a>
        </div>
    </div>
</x-container>
<x-container class="bg-bg-light/80 p-2 md:p-4 lg:p-8">
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
</x-container>
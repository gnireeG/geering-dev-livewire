@props([
    'heading',
    'subheading' => null,
    'breadcrumbs' => []
])
<div class="backend-content pb-20">
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item href="{{ route('dashboard') }}" icon="home" wire:navigate />
        @foreach($breadcrumbs as $breadcrumb)
            <flux:breadcrumbs.item href="{{ $breadcrumb['href'] ?? null }}" wire:navigate>
                {{ $breadcrumb['label'] }}
            </flux:breadcrumbs.item>
        @endforeach
        <flux:breadcrumbs.item>{{ $heading }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <header class="flex justify-between gap-4 flex-wrap">
        <div>
            @if($heading)
                <flux:heading level="1" size="2xl">{{ $heading }}</flux:heading>
            @endif
            @if($subheading)
                <flux:heading level="2" size="md" class="mt-2 text-gray-500 dark:text-gray-400">{{ $subheading }}</flux:heading>
            @endif
        </div>
        <div>
        {{ $actions ?? '' }}
        </div>
    </header>
    <flux:separator class="my-8" />
    {{ $slot }}
</div>
<div>
    <a wire:navigate href="{{ route($attributes['route']) }}" class="text-accent hover:underline flex gap-1 mb-8 items-center">
        <flux:icon.chevron-left variant="mini" />{{ $attributes['name'] ?? 'Back' }}
    </a>
</div>
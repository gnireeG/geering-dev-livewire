<label class=" hover:bg-bg-light group hover:border-accent p-4 rounded-lg shadow cursor-pointer border-2 relative @if($attributes['image']) aspect-[24/9] @endif"
@if(!$attributes['xModel'])
x-data="{ checked: $wire.{{ $attributes['wireModel'] }} }"
@endif
:class="{ 'bg-bg border-transparent': !{{ $attributes['xModel'] ?? 'checked' }}, 'bg-bg-light border-accent': {{ $attributes['xModel'] ?? 'checked' }} }">
    <div @if($attributes['image']) style="background-image: url('{{ asset($attributes['image']) }}')" @endif
    class="bg-right bg-no-repeat size-full bg-contain flex items-end">
        <p class="w-full">
            <span class="group-hover:bg-bg-light flex gap-1 justify-between w-full" :class="{ 'bg-bg': !{{ $attributes['xModel'] ?? 'checked' }}, 'bg-bg-light': {{ $attributes['xModel'] ?? 'checked' }} }">
                {{ __($label) }}
                @if($attributes['image'])
                    <flux:icon.check x-cloak x-show="{{ $attributes['xModel'] ?? 'checked' }}" class="absolute top-2 left-2" />
                @else
                    <flux:icon.check x-cloak x-show="{{ $attributes['xModel'] ?? 'checked' }}" />
                @endif
            </span>
        </p>
        <input type="checkbox" wire:model.lazy="{{ $attributes['wireModel'] }}" class="hidden" x-model="{{ $attributes['xModel'] ?? 'checked' }}" name="{{ __($label) }}" />
    </div>
</label>
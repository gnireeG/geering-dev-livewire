<label class="flex flex-col gap-2 max-w-3xl {{ $attributes['class'] ?? '' }}">
    <span class="font-semibold mb-4">{{ __($attributes['label']) }}</span>
    <textarea rows="5" wire:model.lazy="{{ $attributes['wireModel'] }}" placeholder="{{ __($attributes['placeholder']) }}" spellcheck="false" class="bg-bg-light p-5 rounded-2xl text-sm"></textarea>
</label>
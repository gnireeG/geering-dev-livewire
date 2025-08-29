<label class="flex flex-col gap-2 {{ $attributes['class'] ?? '' }}" {{ $attributes }}>
    <span class="font-semibold mb-4">{{ __($attributes['label']) }}</span>
    <input type="text" wire:model.lazy="{{ $attributes['wireModel'] }}"
    placeholder="{{ __($attributes['placeholder']) }}"
    class="bg-bg-light px-5 py-3 rounded-full text-sm max-w-3xl" />
    @error($attributes['wireModel'])
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
</label>
<label class="flex flex-col gap-2 {{ $attributes['class'] ?? '' }}" {{ $attributes }}>
    <x-forms.label>{{ __($attributes['label']) }}</x-forms.label>
    <input type="text" wire:model.lazy="{{ $attributes['wireModel'] }}"
    placeholder="{{ __($attributes['placeholder']) }}"
    class="bg-bg-light px-5 py-3 rounded-full text-md max-w-3xl" />
    @error($attributes['wireModel'])
        <span class="text-red-500 text-sm mx-5">{{ $message }}</span>
    @enderror
</label>
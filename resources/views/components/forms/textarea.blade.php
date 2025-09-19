<label class="flex flex-col gap-2 max-w-3xl {{ $attributes['class'] ?? '' }}">
    <x-forms.label>{{ __($attributes['label']) }}</x-forms.label>
    <textarea rows="5" wire:model.lazy="{{ $attributes['wireModel'] }}" placeholder="{{ __($attributes['placeholder']) }}" spellcheck="false" class="bg-bg-light p-5 rounded-2xl text-sm"></textarea>
    @error($attributes['wireModel'])
        <span class="text-red-500 text-sm mx-5">{{ $message }}</span>
    @enderror
</label>
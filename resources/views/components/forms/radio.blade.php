<fieldset class="mb-4">
    <legend class="font-semibold mb-4">{{ $label }}</legend>
    @foreach($options as $optionValue => $optionLabel)
        <label class="flex gap-2 items-center mb-2">
            <input 
                type="radio" 
                name="{{ $name }}" 
                value="{{ $optionValue }}"
                x-model="{{ $xModel }}"
                @if(isset($wireModel)) wire:model.lazy="{{ $wireModel }}" @endif
                class="bg-primary accent-primary size-4"
            />
            {{ $optionLabel }}
        </label>
    @endforeach
</fieldset>
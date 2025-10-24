<div class="{{ $attributes['class'] }}" {{ $attributes }}>
    <p class="mb-4"><x-forms.label>{{ __($attributes['label']) }}</x-forms.label></p>
    <div class="autogrid-md gap-4">
        {{$slot}}
    </div>
</div>

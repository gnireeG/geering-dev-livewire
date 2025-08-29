<div class="{{ $attributes['class'] }}" {{ $attributes }}>
    <p class="font-semibold mb-4">{{ __($label) }}</p>
    <div class="autogrid-md gap-4">
        {{$slot}}
    </div>
</div>

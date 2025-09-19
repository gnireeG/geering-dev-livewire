@include('media-library::livewire.partials.collection.fields')

<div class="media-library-field">
    <label class="media-library-label">Alt tag</label>
    <input
        class="media-library-input"
        type="text"
        {{ $mediaItem->livewireCustomPropertyAttributes('alt_tag') }}
    />

    @error($mediaItem->customPropertyErrorName('alt_tag'))
    <span class="media-library-text-error">
       {{ $message }}
    </span>
    @enderror
</div>
<div class="mt-16 flex justify-end">
    @php $current = $this->state()->currentStep(); @endphp
    <div class="flex gap-4">
        @if($current['hasPrevious'])
        <button wire:click="previousStep" class="btn btn-ghost" wire.loading.attr="disabled">
            <flux:icon.chevron-left variant="mini" />
            {{ __('general.previous') }}
        </button>
        @endif
        @if($current['hasNext'])
        <button wire:click="nextStep" class="btn btn-primary">
            {{ __('general.next') }}
            <flux:icon.chevron-right variant="mini" />
        </button>
        @endif
        @if($current['hasSubmit'])
        <button wire:click="submit" class="btn btn-primary" wire.loading.attr="disabled">
            {{ __('general.submit') }} <flux:icon.loading wire:loading wire:target="submit" />
        </button>
        @endif
    </div>
</div>
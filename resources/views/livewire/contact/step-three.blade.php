<div>
    @if(!$complete)
        @include('livewire.contact.step-navigation')
        <div class="bg-bg p-8 rounded-xl md:w-2/3 mx-auto">
            <div class="grid sm:grid-cols-2 gap-4 max-w-3xl">
                <x-forms.text label="{{ __('contact.first_name') }}" wireModel="first_name" class="mb-4" />
                <x-forms.text label="{{ __('contact.last_name') }}" wireModel="last_name" class="mb-4" />
            </div>
            <div class="grid sm:grid-cols-2 gap-4 max-w-3xl">
                <x-forms.text label="{{ __('contact.email') }} *" wireModel="email" class="mb-4" />
                <x-forms.text label="{{ __('contact.phone') }}" wireModel="phone" class="mb-4" />
                <x-forms.text label="{{ __('contact.city') }}" wireModel="city" class="mb-4" class="hidden" aria-hidden="true" />
            </div>
        </div>

        @include('livewire.contact.button-navigation')
    @endif
    @if($complete)
        <div class="flex justify-center items-center h-72">
            <div>
                <flux:icon.check-circle variant="solid" class="w-16 h-16 text-green-500 mx-auto mb-4" />
                <h2 class="text-2xl font-semibold mb-2 text-center">{{ __('contact.thank_you_title') }}</h2>
                <p class="text-center text-muted-foreground">{{ __('contact.thank_you_text') }}</p>
            </div>
        </div>
    @endif
    <button wire:click="$toggle('complete')">toggle thank you screen</button>
</div>

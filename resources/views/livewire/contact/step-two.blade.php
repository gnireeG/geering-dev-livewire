<div x-data="{has_website: $wire.has_website}">
    @include('livewire.contact.step-navigation')
    <?php $pageOne = $this->state()->forStep('contact.step-one'); ?>
    <div class="bg-bg p-8 rounded-xl md:w-2/3 mx-auto">
        {{-- WEBSITE --}}
        @if($pageOne['whatYouNeed']['website'])
        <section class="mb-16">
            <x-forms.radio
            :label="__('contact.has_website')"
            :options="['yes' => __('general.yes'), 'no' => __('general.no')]"
            name="has_website"
            wireModel="has_website"
            xModel="has_website"
            />
            <div x-show="has_website == 'yes'" x-transition>
                <x-forms.text class="mb-4" label="{{ __('contact.existing_website') }}" wireModel="existing_website" placeholder="{{ __('contact.existing_website_placeholder') }}" />
            </div>
            <div class="grid md:grid-cols-2 gap-4">
                <x-forms.textarea class="mb-4" label="{{ __('contact.website_inspiration') }}" wireModel="website_inspiration" placeholder="{{ __('contact.website_inspiration_placeholder') }}" class="mt-8" />
                <x-forms.textarea class="mb-4" label="{{ __('contact.website_dislikes') }}" wireModel="website_dislikes" placeholder="{{ __('contact.website_dislikes_placeholder') }}" class="mt-8" />
            </div>
        </section>
        @endif
        {{-- @if($pageOne['whatYouNeed']['webapp'])
        <section class="mb-16">
            
        </section>
        @endif --}}
        @if($pageOne['whatYouNeed']['online_shop'])
        <section class="mb-16">
            <x-forms.text class="mb-4" label="{{ __('contact.online_shop_products') }}" wireModel="online_shop_products" placeholder="{{ __('contact.online_shop_products_placeholder') }}" />
            <x-forms.textarea class="mb-4" label="{{ __('contact.online_shop_location') }}" wireModel="online_shop_location" placeholder="{{ __('contact.online_shop_location_placeholder') }}" />
        </section>
        @endif
        {{-- @if($pageOne['whatYouNeed']['other'])
        <section class="mb-16">

        </section>
        @endif --}}
        <x-forms.textarea label="{{ __('contact.description') }}" wireModel="description" placeholder="{{ __('contact.description_placeholder') }}" class="mt-8" />
    </div>
    @include('livewire.contact.button-navigation')
</div>

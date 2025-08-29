<div x-data="{existingWebsite: $wire.existing_website}">
    @include('livewire.contact.step-navigation')
    <?php $pageOne = $this->state()->forStep('contact.step-one'); ?>
    {{-- WEBSITE --}}
    @if($pageOne['whatYouNeed']['website'])
    <section class="mb-16">
        <x-forms.radio
        :label="__('contact.existing_website')"
        :options="['yes' => __('general.yes'), 'no' => __('general.no')]"
        name="existing_website"
        wireModel="existing_website"
        xModel="existingWebsite"
        />
        <div x-show="existingWebsite == 'yes'" x-transition>
            <x-forms.text class="mb-4" label="contact.website_url" wireModel="websiteUrl" placeholder="contact.website_url_placeholder" />
        </div>
        <div class="grid md:grid-cols-2 gap-4">
            <x-forms.textarea class="mb-4" label="contact.website_inspiration" wireModel="website_inspiration" placeholder="contact.website_inspiration_placeholder" class="mt-8" />
            <x-forms.textarea class="mb-4" label="contact.website_dislikes" wireModel="website_dislikes" placeholder="contact.website_dislikes_placeholder" class="mt-8" />
        </div>
    </section>
    @endif
    {{-- @if($pageOne['whatYouNeed']['webapp'])
    <section class="mb-16">
        
    </section>
    @endif --}}
    @if($pageOne['whatYouNeed']['online_shop'])
    <section class="mb-16">
        <x-forms.text class="mb-4" label="contact.online_shop_products" wireModel="online_shop_products" placeholder="contact.online_shop_products_placeholder" />
        <x-forms.textarea class="mb-4" label="contact.online_shop_location" wireModel="online_shop_location" placeholder="contact.online_shop_location_placeholder" />
    </section>
    @endif
     {{-- @if($pageOne['whatYouNeed']['other'])
    <section class="mb-16">

    </section>
    @endif --}}
    <x-forms.textarea label="contact.description" wireModel="description" placeholder="contact.description_placeholder" class="mt-8" />
    @include('livewire.contact.button-navigation')
</div>

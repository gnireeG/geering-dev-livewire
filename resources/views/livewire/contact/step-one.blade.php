<div x-data="{showOtherText: $wire.whatYouNeed.other }">
    @include('livewire.contact.step-navigation')
    
    <h2>{{ __('contact.what_do_you_need') }}</h2>

    <x-forms.checkbox.container class="mt-8" label="contact.what_do_you_need">
        <x-forms.checkbox.card label="contact.website" wireModel="whatYouNeed.website" image="images/contact/website.svg" />
        <x-forms.checkbox.card label="contact.webapp" wireModel="whatYouNeed.webapp" image="images/contact/webapp.svg" />
        <x-forms.checkbox.card label="contact.online_shop" wireModel="whatYouNeed.online_shop" image="images/contact/online-shop.svg" />
        <x-forms.checkbox.card label="contact.other" xModel="showOtherText" wireModel="whatYouNeed.other" image="images/contact/other.svg" />
    </x-forms.checkbox.container>
    <div x-show="showOtherText" x-transition class="mt-8">
        <x-forms.text label="contact.other_description" wireModel="otherDescription" placeholder="contact.other_description_placeholder" />
    </div>
    
    @include('livewire.contact.button-navigation')
</div>

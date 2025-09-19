<x-container>
    <div>
        <livewire:contact.contact-wizard />
        <flux:separator class="my-16" :text="__('contact.other_contact_options')" />
        <div class="md:w-4/5 lg:w-3/5 mx-auto mb-8">
            <h2>{{ __('contact.email') }}</h2>
            <p class="mb-4">{{ __('contact.email_description') }}</p>
            <a href="mailto:joel@geering.dev" class="btn btn-outline"><flux:icon.envelope variant="mini" />&nbsp;joel@geering.dev</a>
        </div>
        <div class="md:w-4/5 lg:w-3/5 mx-auto mb-8 text-right">
            <h2>{{ __('contact.linkedin') }}</h2>
            <p class="mb-4">{{ __('contact.linkedin_description') }}</p>
            <a href="https://www.linkedin.com/in/joel-geering-333a471b9/" target="_blank" rel="noopener noreferrer" class="btn btn-outline">{{ __('contact.lets_connect') }}</a>
        </div>
    </div>
</x-container>

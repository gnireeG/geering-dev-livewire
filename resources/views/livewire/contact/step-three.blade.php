<div>
    @include('livewire.contact.step-navigation')
    <div class="grid sm:grid-cols-2 gap-4 max-w-3xl">
        <x-forms.text label="contact.first_name" wireModel="first_name" class="mb-4" />
        <x-forms.text label="contact.last_name" wireModel="last_name" class="mb-4" />
    </div>
    <div class="grid sm:grid-cols-2 gap-4 max-w-3xl">
        <x-forms.text label="contact.email" wireModel="email" class="mb-4" />
        <x-forms.text label="contact.phone" wireModel="phone" class="mb-4" />
    </div>
    @include('livewire.contact.button-navigation')
</div>

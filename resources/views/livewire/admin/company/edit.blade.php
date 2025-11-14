<x-layouts.app.content :heading="$company->name" subheading="Update the company details."
    :breadcrumbs="[
        ['label' => 'All Companies', 'href' => route('company.index')],
    ]">
    <flux:tab.group>
        <flux:tabs variant="pills">
            <flux:tab name="details" icon="identification">Company Details</flux:tab>
            <flux:tab name="meetings" icon="calendar">Meetings ({{ $meeting_count }})</flux:tab>
            <flux:tab name="emails" icon="envelope">Emails ({{ $email_count }})</flux:tab>
        </flux:tabs>
        <flux:tab.panel name="details">
            <form wire:submit="save" class="max-w-2xl">
                <flux:field>
                    <flux:label badge="Required">Company Name</flux:label>
                    <flux:input wire:model="name" />
                    <flux:error name="name" />
                </flux:field>
                <div class="grid grid-cols-2 gap-4">
                    <flux:field class="mt-4">
                        <flux:label>Email</flux:label>
                        <flux:input type="email" wire:model="email" type="email" />
                        <flux:error name="email" />
                    </flux:field>
                    <flux:field class="mt-4">
                        <flux:label>Website</flux:label>
                        <flux:input wire:model="website" type="url" />
                        <flux:error name="website" />
                    </flux:field>
                    <flux:field class="mt-4">
                        <flux:label>Phone number</flux:label>
                        <flux:input type="tel" wire:model="phone" />
                        <flux:error name="phone" />
                    </flux:field>
                </div>
                <flux:field variant="inline" class="mt-8">
                    <flux:checkbox wire:model="customer" />
                    <flux:label>Is Customer</flux:label>
                    <flux:error name="customer" />
                </flux:field>
                <flux:fieldset class="my-8">
                    <flux:legend>Address</flux:legend>
                    <flux:field>
                        <flux:label>Street</flux:label>
                        <flux:input wire:model="address" />
                        <flux:error name="address" />
                    </flux:field>
                    <div class="grid grid-cols-6 gap-4 mt-4">
                        <flux:field class="col-span-2">
                            <flux:label>ZIP</flux:label>
                            <flux:input wire:model="zip" />
                            <flux:error name="zip" />
                        </flux:field>
                        <flux:field class="col-span-4">
                            <flux:label>City</flux:label>
                            <flux:input wire:model="city" />
                            <flux:error name="city" />
                        </flux:field>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 sm:gap-4">
                        <flux:field class="mt-4">
                            <flux:label>State</flux:label>
                            <flux:input wire:model="state" />
                            <flux:error name="state" />
                        </flux:field>
                        <flux:field class="mt-4">
                            <flux:label>Country</flux:label>
                            <flux:input wire:model="country" />
                            <flux:error name="country" />
                        </flux:field>
                    </div>
                </flux:fieldset>
                <div class="flex justify-end mt-6">
                    <flux:button type="submit" variant="primary">Update Company</flux:button>
                </div>
            </form>
        </flux:tab.panel>
        <flux:tab.panel name="emails">
            <livewire:components.email-list company_id="{{ $company->id }}" />
        </flux:tab.panel>
        <flux:tab.panel name="meetings">
            <div class="max-w-2xl">
                @foreach($meetings as $meeting)
                    <x-meeting-card :meeting="$meeting" />
                @endforeach
            </div>
            @if($meetings->isEmpty())
                <p class="text-center text-muted">No meetings found for this company.</p>
            @endif
        </flux:tab.panel>
    </flux:tab.group>
</x-layouts.app.content>
<x-layouts.app.content :heading="$company->name" subheading="Update the company details."
    :breadcrumbs="[
        ['label' => 'All Companies', 'href' => route('company.index')],
    ]">
    <flux:tab.group>
        <flux:tabs variant="pills" scrollable scrollable:fade>
            <flux:tab name="details" icon="identification">Details</flux:tab>
            <flux:tab name="meetings" icon="calendar">Meetings ({{ $meeting_count }})</flux:tab>
            <flux:tab name="projects" icon="briefcase">Projects ({{ $project_count }})</flux:tab>
            <flux:tab name="emails" icon="envelope">Emails ({{ $email_count }})</flux:tab>
        </flux:tabs>
        <flux:tab.panel name="details">
            <x-form wire:submit="save" class="max-w-2xl">
                <flux:input wire:model="name" label="Company Name" badge="Required" />
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <flux:input wire:model="email" label="Email" type="email" />
                    <flux:input wire:model="website" label="Website" type="url" />
                    <flux:input wire:model="phone" label="Phone number" type="tel" />
                </div>
                <flux:field variant="inline" class="mt-8">
                    <flux:checkbox wire:model="customer" />
                    <flux:label>Is Customer</flux:label>
                    <flux:error name="customer" />
                </flux:field>
                <flux:fieldset class="my-8">
                    <flux:legend>Address</flux:legend>
                    <flux:input wire:model="address" label="Street" />
                    <div class="grid grid-cols-6 gap-4 mt-4">
                        <div class="col-span-2">
                            <flux:input wire:model="zip" label="ZIP" />
                        </div>
                        <div class="col-span-4">
                            <flux:input wire:model="city" label="City" />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 sm:gap-4">
                        <div class="mt-4">
                            <flux:input wire:model="state" label="State" />
                        </div>
                        <div class="mt-4">
                            <flux:input wire:model="country" label="Country" />
                        </div>
                    </div>
                </flux:fieldset>
                <div class="flex justify-end mt-6">
                    <flux:button type="submit" variant="primary">Update Company</flux:button>
                </div>
            </x-form>
        </flux:tab.panel>
        <flux:tab.panel name="projects">
            <livewire:components.project-list company_id="{{ $company->id }}" />
        </flux:tab.panel>
        <flux:tab.panel name="emails">
            <livewire:components.email-list company_id="{{ $company->id }}" />
        </flux:tab.panel>
        <x-meeting-tab :meetings="$meetings" :company_id="$company->id" />
    </flux:tab.group>
</x-layouts.app.content>
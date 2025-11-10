<x-layouts.app.content heading="Create Company" subheading="Add a new company to the system." :breadcrumbs="[
    ['label' => 'All Companies', 'href' => route('company.index')],
]">
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
            <flux:button type="submit" variant="primary">Create Company</flux:button>
        </div>
    </form>
</x-layouts.app.content>
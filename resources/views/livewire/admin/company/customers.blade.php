<x-layouts.app.content heading="All Customers" subheading="Manage the customers in the system.">
    <x-slot:actions>
        <div class="flex items-center gap-2">
            <flux:input clearable icon="magnifying-glass" size="sm" placeholder="Search" wire:model.live="search" />
            <a wire:navigate href="{{ route('company.create') }}">
                <flux:button icon:trailing="plus" class="cursor-pointer" size="sm">New</flux:button>
            </a>
        </div>
    </x-slot:actions>
    <livewire:components.company-list customer :search="$search" />
</x-layouts.app.content>

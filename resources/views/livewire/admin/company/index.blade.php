<x-layouts.app.content heading="All Companies" subheading="Manage the companies in the system.">
    <x-slot:actions>
        <div  class="flex items-center gap-2">
            <flux:input clearable icon="magnifying-glass" size="sm" placeholder="Search" wire:model.live="search" />
            <a href="{{ route('company.create') }}" wire:navigate>
                <flux:button size="sm" icon:trailing="plus">New</flux:button>
            </a>
        </div>
    </x-slot:actions>
    <livewire:components.company-list :search="$search" />
</x-layouts.app.content>
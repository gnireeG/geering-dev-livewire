<x-layouts.app.content heading="In Progress" subheading="All projects currently in progress." :breadcrumbs="[
    ['label' => 'All Projects', 'href' => route('project.index')]
]">
    <x-slot:actions>
        <div  class="flex items-center gap-2">
            <flux:input clearable icon="magnifying-glass" size="sm" placeholder="Search" wire:model.live="search" />
            <a href="{{ route('project.create') }}" wire:navigate>
                <flux:button size="sm" icon:trailing="plus">New</flux:button>
            </a>
        </div>
    </x-slot:actions>
    <livewire:components.project-list :search="$search" status="in_progress" />
</x-layouts.app.content>
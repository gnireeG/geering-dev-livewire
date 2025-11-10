<x-layouts.app.content heading="All Emails" subheading="Manage the emails in the system.">
    <x-slot:actions>
        <a wire:navigate href="{{ route('email.create') }}">
            <flux:button icon:trailing="plus" class="cursor-pointer" size="sm">New</flux:button>
        </a>
    </x-slot:actions>
    <livewire:components.email-list />
</x-layouts.app.content>

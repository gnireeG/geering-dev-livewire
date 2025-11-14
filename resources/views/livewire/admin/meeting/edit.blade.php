<x-layouts.app.content heading="Edit Meeting" subheading="Modify the details of the meeting." :breadcrumbs="[
    ['label' => 'Calendar', 'href' => route('meeting.calendar')],
]">
    <form wire:submit="save" class="max-w-2xl">
        <div class="grid grid-cols-2 gap-4">
            <flux:fieldset>
                <flux:legend>From</flux:legend>
                <div class="grid grid-cols-2 gap-4">
                    <flux:date-picker wire:model="start_date" label="Date">
                        <x-slot name="trigger">
                            <flux:date-picker.input />
                        </x-slot>
                    </flux:date-picker>
                    <flux:time-picker label="Time" type="input" interval="15" min="07:00" max="23:00" wire:model.live="start_time" />
                </div>
            </flux:fieldset>
            <flux:fieldset>
                <flux:legend>To</flux:legend>
                <div class="grid grid-cols-2 gap-4">
                    <flux:date-picker wire:model="end_date" label="Date">
                        <x-slot name="trigger">
                            <flux:date-picker.input />
                        </x-slot>
                    </flux:date-picker>
                    <flux:time-picker label="Time" type="input" interval="15" min="{{ $start_time ? \Carbon\Carbon::createFromFormat('H:i', $start_time)->addMinutes(15)->format('H:i') : '07:15' }}" max="23:00" wire:model.live="end_time" />
                </div>
            </flux:fieldset>
        </div>
        <flux:field class="mt-4">
            <flux:label>Title</flux:label>
            <flux:input wire:model="title" />
            <flux:error name="title" />
        </flux:field>
        <flux:field class="mt-4">
            <flux:label>Location</flux:label>
            <flux:input wire:model="location" />
            <flux:error name="location" />
        </flux:field>
        <flux:field class="mt-4">
            <flux:label>Description</flux:label>
            <flux:editor wire:model="description" />
            <flux:error name="description" />
        </flux:field>
        <livewire:components.company-picker wire:model="company_id" class="mt-4" />
        <div class="flex justify-end">
            <flux:button type="submit" variant="primary" class="mt-6">Save Changes</flux:button>
        </div>
    </form>
</x-layouts.app.content>
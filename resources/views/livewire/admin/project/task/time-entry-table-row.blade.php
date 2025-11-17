<flux:table.row>
    <flux:table.cell>
        <div class="flex gap-2">
            <flux:date-picker wire:model="start_date">
                <x-slot name="trigger">
                    <flux:date-picker.input size="sm" />
                </x-slot>
            </flux:date-picker>
            <div>
                <flux:time-picker size="sm" type="input" wire:model="start_time" :dropdown="false" />
            </div>
        </div>
    </flux:table.cell>
    <flux:table.cell>
        <div class="flex gap-2">
            <flux:date-picker wire:model="end_date">
                <x-slot name="trigger">
                    <flux:date-picker.input size="sm" />
                </x-slot>
            </flux:date-picker>
            <div>
                <flux:time-picker size="sm" type="input" wire:model="end_time" :dropdown="false" />
            </div>
        </div>
    </flux:table.cell>
    <flux:table.cell>{{ $this->formattedTime($timeentry->total_seconds) }}</flux:table.cell>
    <flux:table.cell>
        @if($timeentry->completed)
            <flux:badge size="sm" color="green">Yes</flux:badge>
        @else
            <flux:badge size="sm" color="yellow">No</flux:badge>
        @endif
    </flux:table.cell>
    <flux:table.cell>
        <flux:textarea wire:model="notes" size="sm" :rows="3" />
    </flux:table.cell>
    <flux:table.cell>
        <div class="flex gap-2 items-center">
            <flux:button variant="danger" size="sm" icon="trash" wire:confirm="Are you sure you want to delete this time entry?" wire:click="$parent.removeTimeentry({{ $timeentry->id }})" />
            <flux:button variant="primary" size="sm" wire:click="save">Update</flux:button>
        </div>
    </flux:table.cell>
</flux:table.row>

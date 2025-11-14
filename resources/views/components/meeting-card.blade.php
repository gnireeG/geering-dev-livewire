@props(['meeting'])

<flux:card>
    <div class="flex flex-col sm:flex-row justify-between gap-4">
        <flux:heading size="md">{{ $meeting->title }}</flux:heading>
        <div class="flex flex-col gap-1">
            <flux:text class="text-right">{{ \Carbon\Carbon::parse($meeting->from)->format('d.m.Y') }}</flux:text>
            <flux:text>{{ \Carbon\Carbon::parse($meeting->from)->format('H:i') }} - {{ \Carbon\Carbon::parse($meeting->to)->format('H:i') }}</flux:text>
        </div>
    </div>
    <flux:text class="flex gap-1 mt-2">
        <flux:icon.calendar variant="micro" />
        <p>{{ $meeting->from }} - {{ $meeting->to }}</p>
    </flux:text>
    @if($meeting->location)
        <div class="flex gap-1 mt-2">
            <flux:icon.map-pin variant="micro" />
            <flux:text>{{ $meeting->location }}</flux:text>
        </div>
    @endif
    @if($meeting->description)
        <flux:accordion class="mt-4">
            <flux:accordion.item>
                <flux:accordion.heading>Description</flux:accordion.heading>
                <flux:accordion.content>
                    <div>
                        {!! $meeting->description !!}
                    </div>
                </flux:accordion.content>
            </flux:accordion.item>
        </flux:accordion>
    @endif
    <div class="flex justify-end mt-4">
        <flux:button href="{{ route('meeting.edit', $meeting) }}" wire:navigate>Edit Meeting</flux:button>
    </div>
</flux:card>
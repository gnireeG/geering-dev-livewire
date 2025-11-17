@props(['meeting'])

<flux:card>
    <a href="{{ route('meeting.edit', $meeting) }}" wire:navigate>
        <div class="flex flex-col sm:flex-row justify-between gap-4">
            <div class="flex flex-col gap-1">
                <flux:heading size="lg">{{ $meeting->title }}</flux:heading>
                @if($meeting->location)
                    <div class="flex gap-1 mt-2">
                        <flux:icon.map-pin variant="micro" />
                        <flux:text>{{ $meeting->location }}</flux:text>
                    </div>
                @endif
            </div>
            <div class="flex flex-col gap-1">
                <flux:heading class="text-right" size="lg">{{ $meeting->from->format('d.m.Y') }}</flux:heading>
                <flux:text>{{ $meeting->from->format('H:i') }} - {{ $meeting->to->format('H:i') }}</flux:text>
            </div>
        </div>
        @if($meeting->project)
            <div class="flex gap-1 mt-2 items-center">
                <flux:icon.briefcase variant="micro" />
                <flux:text>{{ $meeting->project->title }}</flux:text>
            </div>
        @endif
    </a>
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
</flux:card>
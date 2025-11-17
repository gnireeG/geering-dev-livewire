<x-layouts.app.content heading="Calendar" subheading="Manage the meetings in the system.">
    <div class="flex items-center gap-2 justify-end">
        @if($currentWeek !== $todaysWeek)
            <flux:button size="sm" variant="ghost" wire:click="goToToday">Today</flux:button>
        @endif
        <flux:button size="sm" variant="ghost" wire:click="previousWeek"><flux:icon.chevron-left /></flux:button>
        <span class="mx-2 font-bold">Week {{ $currentWeek }}</span>
        <flux:button size="sm" variant="ghost" wire:click="nextWeek"><flux:icon.chevron-right /></flux:button>
    </div>
    <div class="flex gap-2 mt-8 overflow-x-auto">
        @foreach($weekDays as $day)
            <div class="w-64">
                <flux:heading size="lg" class="{{ $day->isToday() ? 'font-bold text-primary' : '' }} mb-2">{{ $day->format('d.m.y') }}</flux:heading>
                <flux:card size="sm" class="p-2">
                    <ul class="space-y-2">
                        @foreach($this->meetings as $meeting)
                            @if($meeting->from->isSameDay($day))
                            <li class="text-xs overflow-x-hidden bg-white dark:bg-zinc-800 rounded-md flex flex-col gap-2">
                                    <a href="{{ route('meeting.edit', $meeting) }}" class="p-1.5" wire:navigate.hover>
                                        <flux:text>{{ $meeting->from->format('H:i') }} - {{ $meeting->to->format('H:i') }}</flux:text>
                                        <flux:heading>{{ $meeting->title }}</flux:heading>
                                        @if($meeting->company)
                                            <flux:text>{{ $meeting->company->name }}</flux:text>
                                        @endif
                                    </a>
                                </li>
                            @endif
                        @endforeach
                        
                        <li>
                            <flux:modal.trigger name="add-meeting" class="w-full"
                            wire:click="setNewMeetingDate('{{ $day->toDateString() }}')">
                                <flux:button size="sm" icon="plus" class="w-full">Add meeting</flux:button>
                            </flux:modal.trigger>
                        </li>
                    </ul>
                </flux:card>
            </div>
        @endforeach
    </div>
    <x-new-meeting-modal>
        <livewire:forms.new-meeting-form :date="$newMeetingDate" :key="'react' .$newMeetingDate" />
    </x-new-meeting-modal>
</x-layouts.app.content>

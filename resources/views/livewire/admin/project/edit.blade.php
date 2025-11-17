<x-layouts.app.content :heading="$project->title" subheading="Edit Project" :breadcrumbs="[
    ['label' => 'All Projects', 'href' => route('project.index')]
]">
    <flux:tab.group>
        <flux:tabs variant="pills" scrollable scrollable:fade>
            <flux:tab name="details" icon="identification">Details</flux:tab>
            <flux:tab name="tasks" icon="check-circle">Tasks ({{ $task_count }})</flux:tab>
            <flux:tab name="meetings" icon="calendar">Meetings ({{ $meeting_count }})</flux:tab>
        </flux:tabs>
        <flux:tab.panel name="details">
            <form class="max-w-2xl flex flex-col gap-4" wire:submit="save">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3 md:grid-cols-4 w-full">
                    <div class="sm:col-span-2 md:col-span-3">
                        <flux:input label="Title" wire:model="title" />
                    </div>
                    <flux:select variant="listbox" wire:model="status" label="Status" class="col-span-1">
                        @foreach(\App\Enums\ProjectStatus::cases() as $statusOption)
                            <flux:select.option value="{{ $statusOption->value }}" :key="$statusOption->value">
                                <flux:badge size="sm" variant="pill" color="{{ $statusOption->color() }}">
                                    {{ $statusOption->label() }}
                                </flux:badge>
                            </flux:select.option>
                        @endforeach
                    </flux:select>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div><flux:date-picker type="date" label="Start Date" wire:model="start_date" clearable /></div>
                    <div><flux:date-picker type="date" label="End Date" wire:model="end_date" clearable /></div>
                </div>
                <livewire:components.company-picker wire:model="company_id" />
                <flux:editor wire:model="description" label="Description" />
                <div class="flex justify-end mt-4">
                    <flux:button type="submit" color="primary">Save Project</flux:button>
                </div>
            </form>
        </flux:tab.panel>
        <flux:tab.panel name="tasks">
            <div class="flex flex-col gap-4 max-w-2xl">
                <livewire:components.task-adder :project="$project" />
                @foreach($tasks as $task)
                    <livewire:components.task-card :task="$task" :key="$task->id . '-' . $tasks_updated_at" />
                @endforeach
            </div>
        </flux:tab.panel>
        <x-meeting-tab :meetings="$meetings" :company_id="$project->company_id" :project_id="$project->id" />
    </flux:tab.group>
</x-layouts.app.content>

<x-layouts.app.content :heading="$task->title" subheading="Modify the details of the task." :breadcrumbs="[
    ['label' => 'All Projects', 'href' => route('project.index')],
    ['label' => $task->project->title, 'href' => route('project.edit', $task->project->id)],
]">
    <x-form wire:submit="save">
        <div class="flex flex-col gap-4">
            <flux:input label="Title" wire:model="title" />
            <flux:editor label="Description" wire:model="description" />
            <flux:date-picker label="Due Date" wire:model="due_date" />
            <flux:checkbox label="Completed" wire:model="is_completed" />
        </div>
        <div class="flex justify-end">
            <flux:button type="submit" variant="primary" class="mt-6">Save Changes</flux:button>
        </div>
    </x-form>
    <flux:separator class="my-8" />
    <flux:heading size="lg">Time Entries</flux:heading>
    <flux:table>
        <flux:table.columns>
            <flux:table.column>From</flux:table.column>
            <flux:table.column>To</flux:table.column>
            <flux:table.column>Duration</flux:table.column>
            <flux:table.column>Completed</flux:table.column>
            <flux:table.column>Notes</flux:table.column>
            <flux:table.column>Actions</flux:table.column>
        </flux:table.columns>
        <flux:table.rows>
            @foreach($timeentries as $t)
                <livewire:admin.project.task.time-entry-table-row :timeentry="$t" :key="$t->id" />
            @endforeach
        </flux:table.rows>
    </flux:table>
</x-layouts.app.content>
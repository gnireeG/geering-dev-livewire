<div>
    <flux:modal.trigger name="task-adder-modal" class="w-full">
        <flux:button size="sm" icon="plus" class="w-full">Add Task</flux:button>
    </flux:modal.trigger>
    <flux:modal name="task-adder-modal" class="w-full max-w-lg">
        <flux:heading size="lg">Add New Task</flux:heading>
        <form wire:submit="save" class="mt-4 flex flex-col gap-4">
            <flux:input label="Title" wire:model="title" />
            <flux:editor label="Description" wire:model="description" />
            <flux:date-picker label="Due Date" wire:model="due_date" clearable />
            <div class="flex justify-end mt-4">
                <flux:button type="submit" variant="primary">Create Task</flux:button>
            </div>
        </form>
    </flux:modal>
</div>
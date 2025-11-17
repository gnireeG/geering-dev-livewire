<flux:card class="{{ $is_completed ? 'opacity-80' : '' }}">
    <div class="flex flex-wrap gap-4 justify-between items-center mb-4">
        <div class="grow">
            <flux:input wire:model="title" :disabled="$is_completed" />
        </div>
        <div>
            <flux:switch label="Completed" wire:model.live="is_completed" />
        </div>
    </div>
    <flux:editor wire:model="description" :disabled="$is_completed" />
    <flux:date-picker wire:model="due_date" :disabled="$is_completed" class="mt-4" :clearable="!$is_completed" />
    <div class="flex justify-between mt-4 gap-4 items-start">
        <div class="flex gap-2 items-center flex-wrap">
            <flux:button size="sm" wire:click="save" :disabled="$is_completed" wire:show="!is_completed">Update</flux:button>
            <a href="{{ route('task.edit', $task->id) }}" wire:navigate><flux:button size="sm" variant="ghost">{{ $this->formattedTotalTime }}</flux:button></a>
        </div>
        <flux:button size="sm" variant="primary" wire:click="startTask" icon="play" :disabled="$is_completed" wire:show="!is_completed">Start</flux:button>
    </div>
</flux:card>
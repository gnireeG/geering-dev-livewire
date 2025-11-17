<div class="fixed bottom-0" id="timetracker" data-timetracker-active="{{ $isActive ? 'true' : 'false' }}">
    @if($task)
        <div class="p-4 flex justify-between items-center mx-6 my-2 lg:mx-8 lg:my-4 border border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 rounded-lg">
            <a href="{{ route('task.edit', $task->id) }}" wire:navigate>    
                <flux:heading size="lg">{{ $task->title ?? 'No task started' }}</flux:heading>
                <flux:text>{{ $task->project->title }}</flux:text>
            </a>
            <div class="flex gap-4 items-center">
                <p id="timer" class="font-mono">00:00:00</p>
                @if($isActive)
                    <flux:modal.trigger name="timetracker-notes-modal">
                        <flux:button variant="danger" size="sm"><flux:icon.stop variant="solid" /></flux:button>
                    </flux:modal.trigger>
                @else
                    <flux:button variant="primary" size="sm" wire:click="startTask({{ $task->id }})"><flux:icon.play variant="solid" /></flux:button>
                    <flux:button variant="ghost" size="sm" wire:click="close"><flux:icon.x-circle variant="solid" /></flux:button>
                @endif

            </div>
        </div>
        <flux:modal name="timetracker-notes-modal" class="w-full max-w-lg">
            <div class="p-6">
                <flux:heading size="lg" class="mb-4">Add Notes for Time Entry</flux:heading>
                <flux:field>
                    <flux:label>Notes</flux:label>
                    <flux:textarea wire:model="notes" rows="4" />
                    <flux:error name="notes" />
                </flux:field>
                <div class="flex justify-between mt-4 gap-2 items-center">
                    <flux:button variant="ghost" size="sm" wire:click="cancelRecording" wire:confirm="Are you sure you want to cancel the time recording? This Time Entry will be deleted.">Cancel time recording</flux:button>
                    <flux:button variant="primary" wire:click="stopTask">Complete</flux:button>
                </div>
            </div>
        </flux:modal>
    @endif
</div>
@script
<script>

let timerRunning = false;
let timerInterval = null;
let backupSyncInterval = null;

$js('onTaskStarted', (taskId) => {
    timerRunning = true;
    const startTime = new Date();
    
    // Main timer update every second
    timerInterval = setInterval(() => {
        const timerElement = document.getElementById('timer');
        if (timerElement) {
            let elapsed = Math.floor((new Date() - startTime) / 1000);
            const hours = Math.floor(elapsed / 3600);
            elapsed %= 3600;
            const minutes = Math.floor(elapsed / 60);
            const seconds = elapsed % 60;

            timerElement.innerText = 
                String(hours).padStart(2, '0') + ':' + 
                String(minutes).padStart(2, '0') + ':' + 
                String(seconds).padStart(2, '0');
        }
    }, 1000);
    
    // Backup sync every minute (doesn't re-render component)
    backupSyncInterval = setInterval(() => {
        console.log('Backup sync triggered');
        if (timerRunning) {
            $wire.tempEndTime();
        } else {
            clearInterval(backupSyncInterval);
        }
    }, 30000); // 30 seconds
});

$js('onTaskStopped', () => {
    timerRunning = false;
    clearInterval(timerInterval);
    clearInterval(backupSyncInterval);
    timerInterval = null;
})
</script>
@endscript
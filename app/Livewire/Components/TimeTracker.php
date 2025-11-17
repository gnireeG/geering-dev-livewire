<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Task;
use Livewire\Attributes\On;
use Livewire\Attributes\Renderless;
use Livewire\Attributes\Rule;
use Flux\Flux;
use Carbon\Carbon;

class TimeTracker extends Component
{

    public ?Task $task = null;
    public bool $isActive = false;

    public bool $timerRunning = false;

    public $timeentry = null;

    #[Rule('nullable|string')]
    public $notes = '';

    #[On('task-started')]
    public function startTask($id)
    {
        if($this->timerRunning) {
            Flux::toast(variant: 'warning', text: 'A timer is already running. Please stop it before starting a new one.');
            return;
        }
        $this->timerRunning = true;
        $this->task = Task::find($id);
        $this->timeentry = $this->task->timeentries()->create([
            'start_time' => Carbon::now(auth()->user()->timezone ?? 'UTC'),
        ]);
        $this->isActive = true;
        $this->js('onTaskStarted', $id);
    }

    public function stopTask()
    {
        $now = Carbon::now(auth()->user()->timezone ?? 'UTC');
        if ($this->timeentry) {
            $this->timeentry->update([
                'end_time' => $now,
                'total_seconds' => $this->timeentry->start_time->diffInSeconds($now),
                'completed' => true,
                'notes' => $this->notes,
            ]);
        }
        $this->timeentry = null;
        $this->isActive = false;
        $this->notes = '';
        $this->timerRunning = false;
        $this->js('onTaskStopped');
        $this->dispatch('task-updated');
        Flux::modal('timetracker-notes-modal')->close();
    }

    #[Renderless]
    public function tempEndTime(){
        $now = Carbon::now(auth()->user()->timezone ?? 'UTC');
        if ($this->timeentry) {
            $this->timeentry->update([
                'end_time' => $now,
                'total_seconds' => $this->timeentry->start_time->diffInSeconds($now),
            ]);
        }
    }

    public function cancelRecording(){
        if ($this->timeentry) {
            $this->timeentry->delete();
        }
        $this->timeentry = null;
        $this->isActive = false;
        $this->notes = '';
        $this->timerRunning = false;
        $this->js('onTaskStopped');
        Flux::modal('timetracker-notes-modal')->close();
    }

    public function close(){
        $this->task = null;
        $this->timeentry = null;
        $this->isActive = false;
    }

    public function render()
    {
        return view('livewire.components.time-tracker');
    }
}

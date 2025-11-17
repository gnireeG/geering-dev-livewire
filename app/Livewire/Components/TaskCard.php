<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Task;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Computed;

class TaskCard extends Component
{

    public Task $task;

    #[Rule('required|string|max:255')]
    public $title = '';

    #[Rule('nullable|string')]
    public $description = '';

    #[Rule('nullable|date')]
    public $due_date = null;

    public $is_completed = false;

    public function save(){
        $validated = $this->validate();

        $this->task->update($validated);
        $this->dispatch('task-updated');
    }

    public function updatedIsCompleted($value)
    {
        $this->task->is_completed = $value;
        $this->task->save();
        $this->dispatch('task-updated');
    }

    public function startTask()
    {
        $this->dispatch('task-started', id: $this->task->id);
    }

    #[Computed]
    public function totalTimeSeconds()
    {
        return $this->task->timeentries()->sum('total_seconds') ?: 0;
    }

    #[Computed]
    public function formattedTotalTime()
    {
        $seconds = $this->totalTimeSeconds;
        
        if ($seconds === 0) {
            return '0h';
        }
        
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        
        if ($hours > 0) {
            return $minutes > 0 ? "{$hours}h {$minutes}m" : "{$hours}h";
        }
        
        return "{$minutes}m";
    }

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->fill($this->task->only([
            'title',
            'description',
            'is_completed',
            'due_date',
        ]));
    }

    public function render()
    {
        return view('livewire.components.task-card');
    }
}

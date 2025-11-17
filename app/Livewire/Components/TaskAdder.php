<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Project;
use App\Models\Task;
use Livewire\Attributes\Rule;
use Flux\Flux;

class TaskAdder extends Component
{

    public Project $project;

    #[Rule('required|string|max:255')]
    public $title = '';

    #[Rule('nullable|string|max:1000')]
    public $description = '';

    #[Rule('nullable|date')]
    public $due_date = null;

    public function save(){
        $validated = $this->validate();
        Task::create([
            'project_id' => $this->project->id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'due_date' => $validated['due_date'],
            'is_completed' => false,
        ]);
        $this->dispatch('task-created');
        $this->reset();
        Flux::modal('task-adder-modal')->close();
    }

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function render()
    {
        return view('livewire.components.task-adder');
    }
}

<?php

namespace App\Livewire\Admin\Project\Task;

use Livewire\Component;
use App\Models\Task;
use Livewire\Attributes\Rule;
use Flux\Flux;

class Edit extends Component
{

    public Task $task;

    public $timeentries = [];

    #[Rule('required|string|max:255')]
    public $title = '';

    #[Rule('nullable|string')]
    public $description = '';

    #[Rule('nullable|date')]
    public $due_date = null;

    #[Rule('boolean')]
    public $is_completed = false;

    public function mount(){
        $this->timeentries = $this->task->timeentries()->get();
        $this->fill($this->task->only([
            'title',
            'description',
            'due_date',
            'is_completed',
        ]));
    }

    public function save(){
        $validated = $this->validate();

        $this->task->update($validated);
        Flux::toast(text: "Task '{$this->task->title}' has been updated.", variant: 'success');
    }

    public function removeTimeentry($id){
        $timeentry = $this->task->timeentries()->find($id);
        if ($timeentry) {
            $timeentry->delete();
            $this->timeentries = $this->task->timeentries()->get(); // Refresh the list
            Flux::toast(text: "Time entry has been removed.", variant: 'success');
        }
    }

    public function render()
    {
        return view('livewire.admin.project.task.edit');
    }
}

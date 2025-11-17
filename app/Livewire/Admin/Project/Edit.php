<?php

namespace App\Livewire\Admin\Project;

use Livewire\Component;
use App\Models\Project;
use Livewire\Attributes\Rule;
use Flux\Flux;
use App\Enums\ProjectStatus;
use Livewire\Attributes\On;

class Edit extends Component
{

    public Project $project;

    public $meetings = [];
    public $meeting_count = 0;

    public $tasks = [];
    public $task_count = 0;
    public $tasks_updated_at;

    public $title = '';
    public $description = '';
    public $start_date = '';
    public $end_date = '';
    public $status = '';
    public $company_id = null;

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'status' => 'required|string|in:' . ProjectStatus::implode(),
            'company_id' => 'nullable|integer|exists:companies,id',
        ];
    }

    #[On('meeting-created')]
    public function loadMeetings()
    {
        $this->meetings = $this->project->meetings()->with('company')->get();
        $this->meeting_count = $this->meetings->count();
    }

    #[On('task-updated')]
    #[On('task-created')]
    public function loadTasks()
    {
        $this->tasks = $this->project->tasks()
            ->with('project')
            ->with('timeentries')
            ->orderBy('is_completed')
            ->orderByRaw('due_date IS NULL') // NULL values come last
            ->orderBy('due_date', 'asc')     // Non-NULL values ordered by date
            ->orderBy('created_at', 'desc')
            ->get();
        $this->task_count = $this->tasks->count();
        $this->tasks_updated_at = now()->timestamp; // Force re-render
    }

    public function mount(Project $project)
    {
        // Project already has relationships loaded from route binding
        $this->project = $project;

        $this->fill($this->project->only([
            'title',
            'description',
            'start_date',
            'end_date',
            'status',
            'company_id'
        ]));

        $this->loadMeetings();
        $this->loadTasks();
    }

    public function save(){
        $validated = $this->validate();
        $this->project->update($validated);
        Flux::toast(variant: 'success', text: 'Project updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.project.edit');
    }
}

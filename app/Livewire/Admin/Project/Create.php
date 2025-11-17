<?php

namespace App\Livewire\Admin\Project;

use Livewire\Component;
use App\Models\Project;
use App\Enums\ProjectStatus;
use Livewire\Attributes\Rule;
use Flux\Flux;

class Create extends Component
{

    public $title = '';
    public $description = '';
    public $start_date = null;
    public $end_date = null;
    public $status = ProjectStatus::PLANNING->value;
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

    public function save(){
        $validated = $this->validate();
        $project = Project::create($validated);
        Flux::toast(variant: 'success', text: 'Project created successfully.');
        $this->redirect(route('project.edit', ['project' => $project->id]));
    }

    public function render()
    {
        return view('livewire.admin.project.create');
    }
}

<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Project;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Computed;

class ProjectPicker extends Component
{

    public $class = '';

    #[Reactive]
    public $company_id = null;

    #[Modelable]
    public $project_id;

    public function render()
    {
        return view('livewire.components.project-picker');
    }

    #[Computed]
    public function projects()
    {
        if ($this->company_id) {
            return Project::where('company_id', $this->company_id)->get();
        }
        return Project::all();
    }

    public function mount($class = '', $company_id = null)
    {
        $this->class = $class;
        $this->company_id = $company_id;
    }
}

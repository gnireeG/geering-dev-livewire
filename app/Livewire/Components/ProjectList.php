<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Project;
use Livewire\Attributes\Computed;

use Livewire\Attributes\Reactive;

class ProjectList extends Component
{

    use WithPagination;

    public $company_id = null;

    public $status = null;

    #[Reactive]
    public $search = '';

    public $sortBy = 'start_date';
    public $sortDirection = 'desc';

    public function sort($column) {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    #[Computed]
    public function projects()
    {
        return Project::query()
            ->tap(fn ($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)
            ->when($this->search, fn ($query) => $query->where('title', 'like', '%' . $this->search . '%'))
            ->when($this->company_id, fn ($query) => $query->where('company_id', $this->company_id))
            ->when($this->status, fn ($query) => $query->where('status', $this->status))
            ->with('company')
            ->paginate(20);
    }

    public function mount($company_id = null, $search = '', $status = null)
    {
        $this->company_id = $company_id;
        $this->search = $search;
        $this->status = $status;
    }

    public function render()
    {
        return view('livewire.components.project-list');
    }
}

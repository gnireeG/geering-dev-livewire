<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Email as EmailModel;
use Livewire\WithPagination;

class EmailList extends Component
{
    use WithPagination;

    public $company_id = null;

    public $sortBy = 'created_at';
    public $sortDirection = 'desc';

    public function sort($column) {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }


    #[\Livewire\Attributes\Computed]
    public function emails()
    {
        return EmailModel::query()
            ->with('company')
            ->tap(fn ($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)
            ->when($this->company_id, fn ($query) => $query->where('company_id', $this->company_id))
            ->paginate(20);
    }

    public function mount($company_id = null)
    {
        $this->company_id = $company_id;
    }

    public function render()
    {
        return view('livewire.components.email-list');
    }
}

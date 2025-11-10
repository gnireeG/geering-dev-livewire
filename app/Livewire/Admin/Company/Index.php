<?php

namespace App\Livewire\Admin\Company;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Company;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;

class Index extends Component
{

    use WithPagination;

    #[Url(as: 'q')]
    public $search = '';

    public $sortBy = 'name';
    public $sortDirection = 'asc';

    public function sort($column) {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    #[\Livewire\Attributes\Computed]
    public function companies()
    {
        return Company::query()
            ->tap(fn ($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)
            ->when($this->search, fn ($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->paginate(20);
    }

    public function render()
    {
        return view('livewire.admin.company.index');
    }
}

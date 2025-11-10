<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Company;
use Livewire\Attributes\Computed;

use Livewire\Attributes\Reactive;

class CompanyList extends Component
{

    use WithPagination;

    public $customer = false;

    #[Reactive]
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

    #[Computed]
    public function companies()
    {
        return Company::query()
            ->tap(fn ($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)
            ->when($this->search, fn ($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->when($this->customer, fn ($query) => $query->where('customer', true))
            ->paginate(20);
    }

    public function mount($customer = false, $search = '')
    {
        $this->customer = $customer;
        $this->search = $search;
    }

    public function render()
    {
        return view('livewire.components.company-list');
    }
}

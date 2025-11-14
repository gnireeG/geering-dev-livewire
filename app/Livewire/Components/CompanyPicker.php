<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Company;
use Livewire\Attributes\Modelable;

class CompanyPicker extends Component
{

    public $class = '';

    public $companies = [];

    #[Modelable]
    public $company_id;

    public function render()
    {
        return view('livewire.components.company-picker');
    }

    public function mount($class = '')
    {
        $this->class = $class;
        $this->companies = Company::all();
    }
}

<?php

namespace App\Livewire\Admin\Company;

use Livewire\Component;
use Livewire\Attributes\Url;

class Customers extends Component
{

    #[Url(as: 'q')]
    public $search = '';

    public function render()
    {
        return view('livewire.admin.company.customers');
    }
}

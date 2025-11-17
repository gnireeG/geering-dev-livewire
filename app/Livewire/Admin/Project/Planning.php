<?php

namespace App\Livewire\Admin\Project;

use Livewire\Component;
use Livewire\Attributes\Url;

class Planning extends Component
{

    #[Url(as: 'q')]
    public $search = '';

    public function render()
    {
        return view('livewire.admin.project.planning');
    }
}

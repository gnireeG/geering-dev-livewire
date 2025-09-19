<?php

namespace App\Livewire\Admin\Contactform;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Contactform;

#[Layout('components.layouts.app')]
#[Title('Contact Forms')]
class Index extends Component
{

    public $contactForms;


    public function mount(){
        $this->contactForms = Contactform::all();
    }

    public function render()
    {
        return view('livewire.admin.contactform.index');
    }
}

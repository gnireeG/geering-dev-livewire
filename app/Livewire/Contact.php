<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;



#[Layout('components.layouts.fenew')]
#[Title('Contact')]
class Contact extends Component
{
    public function render()
    {
        return view('livewire.contact');
    }
}

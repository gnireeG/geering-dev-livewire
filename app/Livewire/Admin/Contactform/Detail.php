<?php

namespace App\Livewire\Admin\Contactform;

use App\Models\Contactform;
use Livewire\Component;

class Detail extends Component
{

    public Contactform $contactform;

    public function render()
    {
        return view('livewire.admin.contactform.detail');
    }
}

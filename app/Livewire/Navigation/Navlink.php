<?php

namespace App\Livewire\Navigation;

use Livewire\Component;

class Navlink extends Component
{
    public $route = '';
    public $name = '';

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.navigation.navlink');
    }
}

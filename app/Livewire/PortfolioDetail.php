<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

use App\Models\Portfolio;

#[Layout('components.layouts.fenew')]
class PortfolioDetail extends Component
{

    public $portfolio;

    public function mount(Portfolio $portfolio)
    {
        //$this->portfolio = $portfolio;
    }

    public function render()
    {
        return view('livewire.portfolio-detail')->title($this->portfolio->title);
    }
}

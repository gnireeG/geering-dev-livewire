<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

use App\Models\Portfolio as PortfolioModel;

#[Layout('components.layouts.fenew')]
#[Title('Portfolio')]
class Portfolio extends Component
{

    public $portfolios;

    public function mount(){
        $this->portfolios = PortfolioModel::with(['media' => function($q){
            $q->orderBy('order_column', 'asc');
        }])->get();
    }

    public function render()
    {
        return view('livewire.portfolio');
    }
}

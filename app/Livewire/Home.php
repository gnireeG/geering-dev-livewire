<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;



#[Title('Homepage')]
class Home extends Component
{

    public $portfolios;

    public function mount(){
        $this->portfolios = \App\Models\Portfolio::with('tags')->orderBy('created_at', 'desc')->limit(3)->get();
    }

    public function render()
    {
        return view('livewire.home')->layout('components.layouts.fenew', [
                'noPadding' => true
            ]);
    }
}

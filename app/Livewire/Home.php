<?php

namespace App\Livewire;

use Livewire\Component;

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
            ])->title(__('general.home'));
    }
}

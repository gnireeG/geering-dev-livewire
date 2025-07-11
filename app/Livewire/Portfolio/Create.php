<?php

namespace App\Livewire\Portfolio;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Portfolio;

#[Layout('components.layouts.app')]
class Create extends Component
{


    public $title;
    public $description;

    public function create(){
        $this->validate([
            'title' => 'required|string|max:255|min:10',
            'description' => 'required|string|max:1000|min:20',
        ]);

        Portfolio::create(['title' => $this->title, 'description' => $this->description]);

        // Redirect to portfolio index after successful creation
        return $this->redirect(route('portfolio.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.portfolio.create');
    }
}

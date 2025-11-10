<?php

namespace App\Livewire\Admin\Portfolio;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Portfolio;
use Flux\Flux;

#[Layout('components.layouts.app')]
#[Title('Portfolios')]
class Index extends Component
{

    public $portfolios;

    public $title;
    public $description;

    public function toggleStatus($id){
        $portfolio = Portfolio::withoutGlobalScopes()->find($id);
        if ($portfolio) {
            $portfolio->published = !$portfolio->published;
            $portfolio->save();
            $this->portfolios = Portfolio::withoutGlobalScopes()->get(); // Refresh the list
            Flux::toast(
                heading: 'Success', 
                text: "Portfolio '{$portfolio->title}' has been " . ($portfolio->published ? 'published' : 'unpublished') . '.', 
                variant: 'success'
            );
        }
    }

    public function create(){
        $this->validate([
            'title' => 'required|string|max:255|min:10',
            'description' => 'required|string|max:1000|min:20',
        ]);

        Portfolio::create(['title' => $this->title, 'description' => $this->description]);

        $this->portfolios = Portfolio::all();
        $this->title = ''; // Reset the title after creation
    }

    public function remove($id){
        $portfolio = Portfolio::withoutGlobalScopes()->find($id);
        if ($portfolio) {
            $portfolio->delete();
            $this->portfolios = Portfolio::withoutGlobalScopes()->get(); // Refresh the list
        }
    }

    public function mount(){
        $this->portfolios = Portfolio::all();
    }

    public function render()
    {
        return view('livewire.admin.portfolio.index');
    }
}

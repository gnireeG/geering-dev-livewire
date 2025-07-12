<?php

namespace App\Livewire\Portfolio;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Portfolio;

use Spatie\MediaLibraryPro\Livewire\Concerns\WithMedia;

#[Layout('components.layouts.app')]
class Editportfolio extends Component
{

    use WithMedia;

    public $portfolio;

    public $title;
    public $description;

    public $images = [];

    public function create(){
        $this->validate([
            'title' => 'required|string|max:255|min:10',
            'description' => 'required|string|max:1000|min:20',
        ]);

        Portfolio::create(['title' => $this->title, 'description' => $this->description]);

        // Redirect to edit page after successful creation
        $this->portfolio = Portfolio::where('title', $this->title)->first();
        if (!$this->portfolio) {
            session()->flash('error', 'Portfolio creation failed. Please try again.');
            return;
        }
        return $this->redirect(route('portfolio.edit', ['id' => $this->portfolio->id]), navigate: true);
    }

    public function update(){
        $this->validate([
            'title' => 'required|string|max:255|min:10',
            'description' => 'required|string|max:1000|min:20',
        ]);

        $this->portfolio->update(['title' => $this->title, 'description' => $this->description]);
        $this->portfolio->addFromMediaLibraryRequest($this->images)->toMediaCollection('images');

        // reload the portfolio from the database
        $this->portfolio = Portfolio::find($this->portfolio->id);
        session()->flash('success', 'Portfolio updated successfully.');
    }

    public function mount($id = null){
        // Initialize media property to prevent null assignment error
        $this->images = [];
        
        if($id){
            $this->portfolio = Portfolio::find($id);
            $this->title = $this->portfolio->title;
            $this->description = $this->portfolio->description;
        }
    }

    public function render()
    {
        $pageTitle = $this->portfolio ? __('Edit Portfolio') : __('Create Portfolio');
        return view('livewire.portfolio.editportfolio', [
            'title' => $pageTitle
        ]);
    }
}

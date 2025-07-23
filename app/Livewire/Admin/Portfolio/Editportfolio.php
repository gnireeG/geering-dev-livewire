<?php

namespace App\Livewire\Admin\Portfolio;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Portfolio;

use Spatie\MediaLibraryPro\Livewire\Concerns\WithMedia;

#[Layout('components.layouts.app')]
class Editportfolio extends Component
{

    use WithMedia;

    public $portfolio;

    public $title;
    public $shortdesc;
    public $description;

    public $images = [];
    public $banner = [];

    public $tags = [];

    public function create(){
        $this->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'shortdesc' => 'nullable|string',
        ]);

        Portfolio::create(['title' => $this->title, 'description' => $this->description, 'shortdesc' => $this->shortdesc]);

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
            'title' => 'required|string',
            'description' => 'required|string',
            'shortdesc' => 'nullable|string',
            'images.*.custom_properties.alt_tag' => 'required|string|max:255',
        ]);

        $this->portfolio->update(['title' => $this->title, 'description' => $this->description, 'shortdesc' => $this->shortdesc]);
        $this->portfolio->addFromMediaLibraryRequest($this->images)->toMediaCollection('images');
        $this->portfolio->addFromMediaLibraryRequest($this->banner)->toMediaCollection('banner');

        $this->portfolio->syncTags($this->tags);

        // reload the portfolio from the database
        $this->portfolio = Portfolio::find($this->portfolio->id);
        $this->setTags();
        session()->flash('success', 'Portfolio updated successfully.');
    }

    private function setTags(){
        $this->tags = [];
        foreach($this->portfolio->tags as $tag){
            $this->tags[] = $tag->name;
        }
    }

    public function mount($id = null){
        // Initialize media property to prevent null assignment error
        $this->images = [];
        $this->banner = [];

        if($id){
            $this->portfolio = Portfolio::with('tags')->find($id);
            $this->title = $this->portfolio->title;
            $this->description = $this->portfolio->description;
            $this->shortdesc = $this->portfolio->shortdesc;
            $this->setTags();
        }
    }

    public function render()
    {
        $pageTitle = $this->portfolio ? __('Edit Portfolio') : __('Create Portfolio');
        return view('livewire.admin.portfolio.editportfolio')->title($pageTitle);
    }
}

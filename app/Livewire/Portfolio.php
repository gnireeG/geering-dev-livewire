<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;


use App\Models\Portfolio as PortfolioModel;
use Spatie\Tags\Tag;

#[Layout('components.layouts.fenew')]
#[Title('Portfolio')]
class Portfolio extends Component
{

    public $tags;
    public $selectedTags = [];
    public $tagsOpen = false;

    #[Computed]
    public function portfolios(){
       $query = PortfolioModel::with(['media' => function($q){
            $q->orderBy('order_column', 'asc');
        }]);

        if (!empty($this->selectedTags)) {
            $query->withAnyTags($this->selectedTags);
        }

        return $query->get(); 
    }

    public function addTag($tagName){
        $this->selectedTags[] = $tagName;
    }



    public function removeTag($tagName){
        $this->selectedTags = array_filter($this->selectedTags, function($tag) use ($tagName) {
            return $tag !== $tagName;
        });
    }

    public function mount(){
        $usedTagIds = DB::table('taggables')->select('tag_id')->distinct()->pluck('tag_id');

        // Get the actual Tag models
        $this->tags = Tag::whereIn('id', $usedTagIds)->get();
    }

    public function render()
    {
        return view('livewire.portfolio');
    }
}

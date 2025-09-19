<?php

namespace App\Livewire\Portfolio;

use Livewire\Component;
use Livewire\Attributes\Computed;

use App\Models\Portfolio;

class Detail extends Component
{

    public $portfolio;

    public function mount($slug)
    {
        $this->portfolio = Portfolio::where('slug', $slug)->where('published', true)->with('media', 'tags')->first();
        if (!$this->portfolio) {
            abort(404);
        }
    }

    #[Computed]
    public function gallery()
    {
        return $this->portfolio->getMedia('images');
    }

    #[Computed]
    public function banner(){
        return $this->portfolio->getMedia('banner');
    }

    public function render()
    {
        return view('livewire.portfolio.detail')
            ->layout('components.layouts.fenew', [
                'noPadding' => true
            ])
            ->title($this->portfolio->title);
    }
}

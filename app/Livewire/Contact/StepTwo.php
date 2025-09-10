<?php

namespace App\Livewire\Contact;

use Spatie\LivewireWizard\Components\StepComponent;
use Livewire\Attributes\Validate;

class StepTwo extends StepComponent
{

    public $has_website = '';
    public $existing_website = '';

    public $hasNext = true;
    public $hasPrevious = true;
    public $hasSubmit = false;

    public $description = '';

    public $online_shop_products = '';
    public $online_shop_location = '';

    public $website_inspiration = '';
    public $website_dislikes = '';

    public function stepInfo() : array
    {
        return [
            'label' => __('contact.more_details'),
        ];
    }

    public function debug(){
        dd($this->state()->all());
    }

    public function render()
    {
        return view('livewire.contact.step-two');
    }
}

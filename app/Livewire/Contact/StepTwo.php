<?php

namespace App\Livewire\Contact;

use Spatie\LivewireWizard\Components\StepComponent;

class StepTwo extends StepComponent
{

    public $existing_website = '';
    public $websiteUrl = '';
    public $website_goal = '';

    public $hasNext = true;
    public $hasPrevious = true;
    public $hasSubmit = false;

    public $description = '';

    public $online_shop_products = '';
    public $online_shop_location = '';

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

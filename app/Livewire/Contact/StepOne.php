<?php

namespace App\Livewire\Contact;

use Spatie\LivewireWizard\Components\StepComponent;

class StepOne extends StepComponent
{

    public $whatYouNeed = [
        'website' => false,
        'webapp' => false,
        'online_shop' => false,
        'other' => false,
    ];


    public $otherDescription = '';

    public $hasNext = true;
    public $hasPrevious = false;
    public $hasSubmit = false;

    public function debug(){
        dd($this->state()->all());
    }

    public function stepInfo() : array
    {
        return [
            'label' => __('contact.what_do_you_need'),
        ];
    }

    public function render()
    {
        return view('livewire.contact.step-one');
    }
}

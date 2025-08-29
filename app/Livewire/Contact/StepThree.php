<?php

namespace App\Livewire\Contact;

use Spatie\LivewireWizard\Components\StepComponent;
use Livewire\Attributes\Validate;

class StepThree extends StepComponent
{

    public $hasNext = false;
    public $hasPrevious = true;
    public $hasSubmit = true;

    #[Validate('string|max:60')]
    public $first_name = '';

    #[Validate('string|max:60')]
    public $last_name = '';

    #[Validate('required|email')]
    public $email = '';

    #[Validate('nullable|regex:/^\+?[0-9\s\-\(\)]{7,20}$/')]
    public $phone = '';

    public function stepInfo() : array
    {
        return [
            'label' => __('contact.contact_information'),
            'last' => true,
        ];
    }

    public function debug(){
        dd($this->state()->all());
    }

    public function render()
    {
        return view('livewire.contact.step-three');
    }
}

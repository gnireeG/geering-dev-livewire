<?php

namespace App\Livewire\Contact;

use Spatie\LivewireWizard\Components\WizardComponent;

class ContactWizard extends WizardComponent
{

    public function steps():array{
        return [
            StepOne::class,
            StepTwo::class,
            StepThree::class,
        ];
    }
}

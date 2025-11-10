<?php

namespace App\Livewire\Contact;

use App\Livewire\Contact;
use Spatie\LivewireWizard\Components\StepComponent;
use Livewire\Attributes\Validate;
use App\Models\Contactform;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormReceived;

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

    // Honeypot / spam prevention field
    #[Validate('nullable|size:0')]
    public $city = '';

    public $complete = false;

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

    public function submit(){
        // Validate the fields
        $this->validate();

        if (!empty($this->city)) {
            // If the honeypot field is filled, we assume it's a bot submission and do nothing
            return;
        }
        
        $hasWebsiteRaw = $this->state()->all()['contact.step-two']['has_website'] ?? null;
        $has_website = ($hasWebsiteRaw === 'yes' || $hasWebsiteRaw === 1 || $hasWebsiteRaw === true) ? 1 : 0;
        
        $data = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'needs' => $this->state()->all()['contact.step-one']['whatYouNeed'] ?? null,
            'needs_other' => $this->state()->all()['contact.step-one']['needs_other'] ?? null,
            'has_website' => $has_website,
            'existing_website' => $this->state()->all()['contact.step-two']['existing_website'] ?? null,
            'website_likes' => $this->state()->all()['contact.step-two']['website_inspiration'] ?? null,
            'website_dislikes' => $this->state()->all()['contact.step-two']['website_dislikes'] ?? null,
            'webshop_products' => $this->state()->all()['contact.step-two']['online_shop_products'] ?? null,
            'webshop_location' => $this->state()->all()['contact.step-two']['online_shop_location'] ?? null,
            'description' => $this->state()->all()['contact.step-two']['description'] ?? null,
        ];

        // Convert 'needs' to JSON if it's an array
        if (is_array($data['needs'])) {
            $data['needs'] = json_encode($data['needs']);
        }

        $form = Contactform::create($data);

        if(env('CONTACTFORM_SEND_MAIL', false)){
            Mail::to(config('mail.admin.address'))->send(new ContactFormReceived($form));
        }

        $this->complete = true;

    }

    public function render()
    {
        return view('livewire.contact.step-three');
    }
}

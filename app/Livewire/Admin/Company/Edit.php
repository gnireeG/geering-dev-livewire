<?php

namespace App\Livewire\Admin\Company;

use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Models\Company;
use Flux\Flux;

class Edit extends Component
{

    public Company $company;

    public $email_count = 0;

    #[Rule('required|string|max:255')]
    public $name = '';

    #[Rule('nullable|string|max:500')]
    public $address = '';

    #[Rule('nullable|string|max:10')]
    public $zip = '';

    #[Rule('nullable|string|max:100')]
    public $city = '';

    #[Rule('nullable|string|max:100')]
    public $state = '';

    #[Rule('nullable|string|max:100')]
    public $country = '';

    #[Rule('nullable|string|max:20')]
    public $phone = '';

    #[Rule('nullable|string|email|max:255')]
    public $email = '';

    #[Rule('nullable|string|max:100')]
    public $website = '';

    #[Rule('boolean')]
    public bool $customer = false;

    public function mount()
    {
        $this->fill($this->company->only([
            'name',
            'address',
            'zip',
            'city',
            'state',
            'country',
            'phone',
            'email',
            'website',
        ]));
        
        // Explicitly cast the boolean to ensure proper binding
        $this->customer = (bool) $this->company->customer;

        $this->email_count = $this->company->emails()->count();
    }

    public function save()
    {
        $validated = $this->validate();

        $this->company->update($validated);

        Flux::toast(text: 'Company updated successfully.', variant: 'success');
    }

    public function render()
    {
        return view('livewire.admin.company.edit');
    }
}

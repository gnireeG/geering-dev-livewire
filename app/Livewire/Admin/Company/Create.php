<?php

namespace App\Livewire\Admin\Company;

use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Models\Company;

class Create extends Component
{

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
    public $customer = false;

    public function save()
    {
        $validated = $this->validate();

        $company = Company::create($validated);

        $this->reset();

        $this->redirectRoute('company.edit', $company);
    }

    public function render()
    {
        return view('livewire.admin.company.create');
    }
}

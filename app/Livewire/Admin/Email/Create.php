<?php

namespace App\Livewire\Admin\Email;

use Livewire\Component;
use Illuminate\Support\Facades\Blade;
use App\Models\Email;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Models\Company;

class Create extends Component
{
    public $subject = '';
    public $recipients = '';
    public $cc = '';
    public $bcc = '';
    public $body = '';
    public $body_text = '';
    public $company_id = null;

    public $showPreview = false;
    public $previewHtml = '';

    public $companies = [];

    public function updatePreview()
    {
        // Create a temporary Blade template string and render it
        $templateContent = '<x-layouts.mail>{!! $body !!}</x-layouts.mail>';
        
        // Use Blade::render to properly process the components
        $this->previewHtml = \Illuminate\Support\Facades\Blade::render($templateContent, [
            'body' => $this->body
        ]);
        
        $this->showPreview = true;
    }

    public function save(){

        $this->validate([
            'subject' => 'required|string|max:255',
            'recipients' => 'nullable|string',
            'cc' => 'nullable|string',
            'bcc' => 'nullable|string',
            'body' => 'nullable|string',
            'body_text' => 'nullable|string',
            'company_id' => 'nullable|integer|exists:companies,id',
        ]);

        $mail = Email::create([
            'subject' => $this->subject,
            'recipients' => $this->recipients,
            'cc' => $this->cc,
            'bcc' => $this->bcc,
            'body' => $this->body,
            'body_text' => $this->body_text,
            'company_id' => $this->company_id,
        ]);

        $this->reset();
        $this->redirect(route('email.edit', $mail));

        //Mail::to($this->recipients)->send(new SendEmail($mail));
    }

    public function mount(){
        $this->companies = Company::all();
    }

    public function render()
    {
        return view('livewire.admin.email.create');
    }
}

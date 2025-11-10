<?php

namespace App\Livewire\Admin\Email;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Flux\Flux;
use App\Models\Email as EmailModel;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Models\Company;

class Edit extends Component
{
    public EmailModel $email;
    
    #[Rule('required|string|max:255')]
    public $subject = '';
    
    #[Rule('nullable|string')]
    public $recipients = '';
    
    #[Rule('nullable|string')]
    public $cc = '';
    
    #[Rule('nullable|string')]
    public $bcc = '';
    
    #[Rule('nullable|string')]
    public $body = '';
    
    #[Rule('nullable|string')]
    public $body_text = '';
    
    #[Rule('required|in:no_reply,replied')]
    public $reply_status = 'no_reply';

    #[Rule('nullable|integer')]
    public $company_id = null;

    public $showPreview = false;
    public $previewHtml = '';

    public $companies = [];

    public function mount()
    {
        $this->fill($this->email->only([
            'subject', 
            'recipients', 
            'cc', 
            'bcc', 
            'body', 
            'body_text', 
            'status', 
            'reply_status',
            'company_id'
        ]));
        $this->companies = Company::all();
    }

    public function updatePreview()
    {
        $templateContent = '<x-layouts.mail>{!! $body !!}</x-layouts.mail>';
        
        $this->previewHtml = \Illuminate\Support\Facades\Blade::render($templateContent, [
            'body' => $this->body
        ]);
        
        $this->showPreview = true;
    }

    public function save()
    {
        $validated = $this->validate();
        
        $this->email->update($validated);
        
        Flux::toast(heading: 'Success', text: 'Email updated successfully.', variant: 'success');
    }

    public function sendMail()
    {
        try {
            Mail::to($this->recipients)->send(new SendEmail($this->email));
        } catch (\Exception $e) {
            $this->email->update(['status' => 'failed']);
            Flux::toast(heading: 'Error', text: 'Failed to send email: ' . $e->getMessage(), variant: 'warning', duration: 0);
            return;
        }
        
        
        $this->email->update(['status' => 'sent', 'sent_at' => now()]);
        Flux::toast(heading: 'Success', text: 'Email sent successfully.', variant: 'success');
    }

    public function render()
    {
        return view('livewire.admin.email.edit');
    }
}

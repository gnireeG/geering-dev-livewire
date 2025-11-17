<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Models\Meeting;
use Carbon\Carbon;
use Livewire\Attributes\Reactive;
use Flux\Flux;

class NewMeetingForm extends Component
{

    
    public $meetingDate = null;
    public $meetingTime = '08:00';
    public $meetingEndDate = null;
    public $meetingEndTime = '09:00';
    public $meetingTitle = '';
    public $meetingDescription = '';
    public $meetingCompanyId = null;
    public $meetingLocation = '';
    public $meetingProjectId = null;

    public function rules()
    {
        return [
            'meetingTitle' => 'required|string|max:255',
            'meetingDescription' => 'nullable|string',
            'meetingCompanyId' => 'nullable|integer|exists:companies,id',
            'meetingProjectId' => 'nullable|integer|exists:projects,id',
            'meetingLocation' => 'nullable|string|max:255',
            'meetingDate' => 'required|date',
            'meetingTime' => 'required|date_format:H:i',
            'meetingEndDate' => [
                'required',
                'date',
                'after_or_equal:meetingDate'
            ],
            'meetingEndTime' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    if ($this->meetingDate && $this->meetingTime && $this->meetingEndDate && $value) {
                        $startDateTime = Carbon::parse($this->meetingDate . ' ' . $this->meetingTime);
                        $endDateTime = Carbon::parse($this->meetingEndDate . ' ' . $value);
                        
                        if ($endDateTime->lessThanOrEqualTo($startDateTime->addMinutes(15))) {
                            $fail('The end time must be at least 15 minutes after the start time.');
                        }
                    }
                }
            ]
        ];
    }
    
    #[Reactive]
    public $date = null;
    
    #[Reactive]
    public $company_id = null;
    
    #[Reactive]
    public $project_id = null;

    public function updatedDate($value)
    {
        $this->meetingDate = $value;
        $this->meetingEndDate = $value;
    }

    public function updatedCompanyId($value)
    {
        $this->meetingCompanyId = $value;
    }

    public function updatedProjectId($value)
    {
        $this->meetingProjectId = $value;
    }

    public function mount($date = null, $company_id = null, $project_id = null)
    {
        $now = Carbon::now(auth()->user()->timezone ?? 'UTC');
        $this->meetingDate = $date ?? $now->toDateString();
        $this->meetingEndDate = $date ?? $now->toDateString();
        $this->meetingCompanyId = $company_id;
        $this->meetingProjectId = $project_id;
    }
    public function saveMeeting(){
        $validated = $this->validate();
        
        $meeting = Meeting::create([
            'from' => Carbon::parse($this->meetingDate . ' ' . $this->meetingTime),
            'to' => Carbon::parse($this->meetingEndDate . ' ' . $this->meetingEndTime),
            'title' => $this->meetingTitle,
            'description' => $this->meetingDescription,
            'company_id' => $this->meetingCompanyId,
            'location' => $this->meetingLocation,
            'project_id' => $this->meetingProjectId,
        ]);

        $this->dispatch('meeting-created');
        
        $this->meetingDate = null;
        $this->meetingTime = '08:00';
        $this->meetingEndDate = null;
        $this->meetingEndTime = '09:00';
        $this->meetingTitle = '';
        $this->meetingDescription = '';
        $this->meetingCompanyId = null;
        $this->meetingLocation = '';
        $this->meetingProjectId = null;

        Flux::toast(variant: 'success', text: 'Meeting created successfully.');
        Flux::modal('add-meeting')->close();


    }

    public function render()
    {
        return view('livewire.forms.new-meeting-form');
    }
}

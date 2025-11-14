<?php

namespace App\Livewire\Admin\Meeting;

use Livewire\Component;
use App\Models\Meeting;
use Carbon\Carbon;

class Edit extends Component
{

    public Meeting $meeting;

    public $title = '';
    public $description = '';
    public $company_id = null;
    public $location = '';
    public $start_date = '';
    public $start_time = '';
    public $end_date = '';
    public $end_time = '';

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'company_id' => 'nullable|integer|exists:companies,id',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date'
            ],
            'end_time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    if ($this->start_date && $this->start_time && $this->end_date && $value) {
                        $startDateTime = Carbon::parse($this->start_date . ' ' . $this->start_time);
                        $endDateTime = Carbon::parse($this->end_date . ' ' . $value);
                        
                        if ($endDateTime->lessThanOrEqualTo($startDateTime->addMinutes(15))) {
                            $fail('The end time must be at least 15 minutes after the start time.');
                        }
                    }
                }
            ]
        ];
    }

    public function mount()
    {
        $this->fill($this->meeting->only([
            'title',
            'description',
            'company_id',
            'location',
        ]));

        $this->start_date = $this->meeting->from->format('Y-m-d');
        $this->start_time = $this->meeting->from->format('H:i');
        $this->end_date = $this->meeting->to->format('Y-m-d');
        $this->end_time = $this->meeting->to->format('H:i');
    }

    public function save(){
        $validated = $this->validate();
        
        $this->meeting->update([
            'from' => Carbon::parse($this->start_date . ' ' . $this->start_time),
            'to' => Carbon::parse($this->end_date . ' ' . $this->end_time),
            'title' => $this->title,
            'description' => $this->description,
            'company_id' => $this->company_id,
            'location' => $this->location,
        ]);
    }

    public function render()
    {
        return view('livewire.admin.meeting.edit');
    }
}

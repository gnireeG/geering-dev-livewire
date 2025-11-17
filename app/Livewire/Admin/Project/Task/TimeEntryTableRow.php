<?php

namespace App\Livewire\Admin\Project\Task;

use Livewire\Component;
use App\Models\Timeentry;
use Carbon\Carbon;
use Flux\Flux;

class TimeEntryTableRow extends Component
{

    public Timeentry $timeentry;

    public $start_date = '';
    public $start_time = '';
    public $end_date = '';
    public $end_time = '';
    public $completed = false;
    public $notes = '';

    public function rules(){
        return [
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
                function($attribute, $value, $fail) {
                    if ($this->start_date && $this->start_time && $this->end_date && $value) {
                        $startDateTime = Carbon::parse($this->start_date . ' ' . $this->start_time);
                        $endDateTime = Carbon::parse($this->end_date . ' ' . $value);
                        
                        if ($endDateTime->lessThanOrEqualTo($startDateTime)) {
                            $fail('The end time must be after the start time.');
                        }
                    }
                }
            ],
            'completed' => 'boolean',
            'notes' => 'nullable|string',
        ];
    }

    public function save(){
        $validated = $this->validate();
        
        $startDateTime = Carbon::parse($validated['start_date'] . ' ' . $validated['start_time']);
        $endDateTime = Carbon::parse($validated['end_date'] . ' ' . $validated['end_time']);

        $this->timeentry->update([
            'start_time' => $startDateTime,
            'end_time' => $endDateTime,
            'total_seconds' => $startDateTime->diffInSeconds($endDateTime),
            'completed' => true,
            'notes' => $validated['notes'],
        ]);
        
        Flux::toast(text: "Time Entry has been updated.", variant: 'success');
    }

    public function formattedTime($seconds)
    {
        if ($seconds === 0 || !$seconds) {
            return '0h';
        }
        
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        
        $formatted = '';
        if ($hours > 0) {
            $formatted .= "{$hours}h ";
        }
        if ($minutes > 0) {
            $formatted .= "{$minutes}m";
        }
        
        
        return trim($formatted);

    }

    public function mount(){
        $this->setupFormData();
    }
    
    public function setupFormData()
    {
        $this->fill($this->timeentry->only([
            'completed',
            'notes',
        ]));
        
        // Format dates for Flux UI compatibility
        if ($this->timeentry->start_time) {
            $this->start_date = $this->timeentry->start_time->toDateString(); // Y-m-d format
            $this->start_time = $this->timeentry->start_time->format('H:i');
        }
        
        if ($this->timeentry->end_time) {
            $this->end_date = $this->timeentry->end_time->toDateString(); // Y-m-d format
            $this->end_time = $this->timeentry->end_time->format('H:i');
        } else {
            // Set current date/time for ongoing entries
            $this->end_date = now()->toDateString();
            $this->end_time = now()->format('H:i');
        }
    }

    public function render()
    {
        return view('livewire.admin.project.task.time-entry-table-row');
    }
}

<?php

namespace App\Livewire\Admin\Meeting;

use Livewire\Component;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Session;
use Livewire\Attributes\Rule;
use App\Models\Meeting;

class Calendar extends Component
{
    #[Rule('required|date')]
    public $newMeetingDate = null;

    #[Rule('required|date_format:H:i')]
    public $newMeetingTime = '08:00';

    #[Rule('required|date')]
    public $newMeetingEndDate = null;

    #[Rule('required|date_format:H:i')]
    public $newMeetingEndTime = '09:00';

    #[Rule('required|string|max:255')]
    public $newMeetingTitle = '';

    #[Rule('nullable|string')]
    public $newMeetingDescription = '';

    #[Rule('nullable|integer|exists:companies,id')]
    public $newMeetingCompanyId = null;

    #[Rule('nullable|string|max:255')]
    public $newMeetingLocation = '';

    public function saveMeeting(){
        $validated = $this->validate();

        $meeting = Meeting::create([
            'from' => Carbon::parse($this->newMeetingDate . ' ' . $this->newMeetingTime),
            'to' => Carbon::parse($this->newMeetingEndDate . ' ' . $this->newMeetingEndTime),
            'title' => $this->newMeetingTitle,
            'description' => $this->newMeetingDescription,
            'company_id' => $this->newMeetingCompanyId,
            'location' => $this->newMeetingLocation,
        ]);
    }


    public $todaysWeek;

    #[Session]
    public $currentWeek;
    
    #[Session]
    public $currentYear;

    public $weekDays = [];

    private function localNow(){
        return Carbon::now(auth()->user()->timezone ?? 'UTC');
    }

    #[Computed]
    public function meetings()
    {
        $startOfWeek = $this->localNow()->setISODate($this->currentYear, $this->currentWeek, 1)->startOfDay();
        $endOfWeek = $this->localNow()->setISODate($this->currentYear, $this->currentWeek, 5)->endOfDay();

        return Meeting::whereBetween('from', [$startOfWeek, $endOfWeek])
            ->orWhereBetween('to', [$startOfWeek, $endOfWeek])
            ->orderBy('from')
            ->get();
    }
    
    public function mount()
    {
        $now = $this->localNow();
        $this->todaysWeek = $now->week;
        
        // Ensure both week and year are always set
        if(!$this->currentWeek || !$this->currentYear) {
            $this->currentWeek = $now->week;
            $this->currentYear = $now->year;
        }
        
        $this->loadWeekDaysForWeek($this->currentWeek);
    }
    
    public function loadWeekDays()
    {
        $this->weekDays = [];
        $monday = $this->localNow()->startOfWeek();
        
        // Get Monday through Friday
        for ($i = 0; $i < 5; $i++) {
            $this->weekDays[] = $monday->copy()->addDays($i);
        }
    }
    
    public function previousWeek()
    {
        $this->currentWeek--;
        
        // Check if we need to go to previous year
        if ($this->currentWeek < 1) {
            $this->currentYear--;
            // Get the last week of the previous year
            $lastWeekOfPrevYear = $this->localNow()->setISODate($this->currentYear, 53, 1);
            // Check if week 53 exists, otherwise use week 52
            if ($lastWeekOfPrevYear->year == $this->currentYear) {
                $this->currentWeek = 53;
            } else {
                $this->currentWeek = 52;
            }
        }
        
        $this->loadWeekDaysForWeek($this->currentWeek);
    }
    
    public function nextWeek()
    {
        $this->currentWeek++;
        
        // Check if we need to go to next year
        $testWeek = $this->localNow()->setISODate($this->currentYear, $this->currentWeek, 1);
        if ($testWeek->year != $this->currentYear) {
            $this->currentYear++;
            $this->currentWeek = 1;
        }
        
        $this->loadWeekDaysForWeek($this->currentWeek);
    }

    public function goToToday(){
        $now = $this->localNow();
        $this->currentWeek = $now->week;
        $this->currentYear = $now->year;
        $this->loadWeekDaysForWeek($this->currentWeek);
    }
    
    private function loadWeekDaysForWeek($weekNumber)
    {
        $this->weekDays = [];
        $monday = $this->localNow()->setISODate($this->currentYear, $weekNumber, 1);
        
        for ($i = 0; $i < 5; $i++) {
            $this->weekDays[] = $monday->copy()->addDays($i);
        }
    }
    
    public function setNewMeetingDate($date)
    {
        $this->newMeetingDate = $date;
        $this->newMeetingEndDate = $date; // Same day by default
    }

    public function render()
    {
        return view('livewire.admin.meeting.calendar');
    }
}

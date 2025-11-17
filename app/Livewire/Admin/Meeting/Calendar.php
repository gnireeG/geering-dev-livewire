<?php

namespace App\Livewire\Admin\Meeting;

use Livewire\Component;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Session;
use Livewire\Attributes\Rule;
use App\Models\Meeting;
use Livewire\Attributes\On;

class Calendar extends Component
{


    public $todaysWeek;

    #[Session]
    public $currentWeek;
    
    #[Session]
    public $currentYear;

    public $weekDays = [];

    private function localNow(){
        return Carbon::now(auth()->user()->timezone ?? 'UTC');
    }

    #[On('meeting-created')]
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

    public function render()
    {
        return view('livewire.admin.meeting.calendar');
    }


    // New properties to hold the selected dates (passing down to the form component as a reactive prop)
    public $newMeetingDate = null;
    public $newMeetingEndDate = null;
    
    public function setNewMeetingDate($date)
    {
        $this->newMeetingDate = $date;
        $this->newMeetingEndDate = $date;
    }

}

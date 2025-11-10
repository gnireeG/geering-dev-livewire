<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Flux\Flux;

new class extends Component {
    public $timezone;
    
    // Common timezones for easy selection
    public $timezones = [
        'UTC' => 'UTC',
        'America/Sao_Paulo' => 'Brazil (São Paulo)',
        'America/New_York' => 'US Eastern',
        'America/Los_Angeles' => 'US Pacific',
        'America/Merida' => 'Mexico (Cancun/Merida)',
        'Europe/London' => 'London',
        'Europe/Berlin' => 'Berlin',
        'Europe/Paris' => 'Paris',
        'Europe/Zurich' => 'Zurich',
        'Asia/Tokyo' => 'Tokyo',
        'Australia/Sydney' => 'Sydney',
    ];

    public function mount()
    {
        $this->timezone = Auth::user()->timezone ?? 'UTC';
    }

    public function save()
    {
        $this->validate([
            'timezone' => 'required|string'
        ]);

        Auth::user()->update(['timezone' => $this->timezone]);
        
        Flux::toast(
            heading: 'Success', 
            text: 'Your timezone preference has been updated successfully.', 
            variant: 'success'
        );
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Timezone')" :subheading="__('Update your timezone preference')">
        <div class="max-w-xl">
        <flux:field>
            <flux:label>Your Timezone</flux:label>
            <flux:description>
                Set your preferred timezone. This affects how dates and times are displayed for you throughout the application.
            </flux:description>
            <flux:select wire:model="timezone">
                <option value="">Select a timezone...</option>
                @foreach($timezones as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </flux:select>
            <flux:error name="timezone" />
        </flux:field>

        <div class="mt-6">
            <flux:button variant="primary" wire:click="save">
                Save Preferences
            </flux:button>
        </div>

        <div class="mt-8 p-4 bg-bg-light rounded-lg">
            <flux:heading level="3" size="sm">Current Information</flux:heading>
            <div class="mt-2 text-sm text-muted">
                <p><strong>Database Timezone:</strong> UTC (for consistency)</p>
                <p><strong>Your Timezone:</strong> {{ auth()->user()->timezone ?? 'UTC' }}</p>
                <p><strong>UTC Time:</strong> {{ now()->utc()->format('Y-m-d H:i:s') }} UTC</p>
                <p><strong>Your Local Time:</strong> {{ $timezone ? now()->setTimezone($timezone)->format('Y-m-d H:i:s T') : 'Please select a timezone' }}</p>
            </div>
            
            <div class="mt-4 text-xs text-muted">
                <strong>Note:</strong> Data is stored in UTC in the database, but displayed in your selected timezone. 
                Each user can have their own timezone preference.
            </div>
        </div>
    </div>
    </x-settings.layout>
</section>

<form wire:submit="saveMeeting">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Add meeting</flux:heading>
            <flux:text class="mt-2">Fill in the details for the new meeting.</flux:text>
        </div>
        <div>
            <flux:fieldset>
                <flux:legend>From</flux:legend>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <flux:date-picker wire:model="meetingDate" label="Date" :initial-date="$meetingDate ?? now()->toDateString()">
                            <x-slot name="trigger">
                                <flux:date-picker.input />
                            </x-slot>
                        </flux:date-picker>
                    </div>
                    <div>
                        <flux:time-picker label="Time" type="input" interval="15" min="07:00" max="23:00" wire:model="meetingTime" />
                    </div>
                </div>
            </flux:fieldset>
            <flux:fieldset class="mt-4">
                <flux:legend>To</flux:legend>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <flux:date-picker wire:model="meetingEndDate" label="Date" :initial-date="$meetingEndDate ?? now()->toDateString()">
                            <x-slot name="trigger">
                                <flux:date-picker.input />
                            </x-slot>
                        </flux:date-picker>
                    </div>
                    <div>
                        <flux:time-picker label="Time" type="input" interval="15" min="07:00" max="23:00" wire:model="meetingEndTime" />
                    </div>
                </div>
            </flux:fieldset>
            <div class="flex flex-col gap-4 mt-4">
                <flux:input label="Title" wire:model="meetingTitle" badge="required" />
                <flux:input label="Location" wire:model="meetingLocation" />
                <flux:editor wire:model="meetingDescription" label="Description" />
                <livewire:components.company-picker wire:model.live="meetingCompanyId" class="mt-4" />
                <livewire:components.project-picker wire:model.live="meetingProjectId" :company_id="$meetingCompanyId" class="mt-4" />
            </div>
        </div>
        <div class="flex">
            <flux:spacer />
            <flux:button type="submit" variant="primary">Save meeting</flux:button>
        </div>
    </div>
</form>

@props(['meetings', 'project_id' => null, 'company_id' => null])
<flux:tab.panel name="meetings">
    <div class="flex justify-end mb-4 max-w-2xl">
        <flux:modal.trigger name="add-meeting">
            <flux:button size="sm" icon="plus" class="w-full">Add meeting</flux:button>
        </flux:modal.trigger>
    </div>
    <div class="flex flex-col gap-4 max-w-2xl">
        @foreach($meetings as $meeting)
            <x-meeting-card :meeting="$meeting" />
        @endforeach
    </div>
</flux:tab.panel>
<x-new-meeting-modal>
    <livewire:forms.new-meeting-form :company_id="$company_id" :project_id="$project_id" />
</x-new-meeting-modal>
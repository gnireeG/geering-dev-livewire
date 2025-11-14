<x-layouts.app.content heading="Create Email" subheading="Compose and send a new email." :breadcrumbs="[
    ['label' => 'All Emails', 'href' => route('email.index')],
]">
    <div>
        <livewire:components.company-picker wire:model="company_id" />
        <flux:field class="mt-4">
            <flux:label>Subject</flux:label>
            <flux:input wire:model="subject" />
            <flux:error name="subject" />
        </flux:field>
        <flux:field class="mt-4">
            <flux:label>Recipients (comma separated)</flux:label>
            <flux:input wire:model="recipients" />
            <flux:error name="recipients" />
        </flux:field>
        <div x-data="{ open: false }">
            <flux:field x-show="open" class="mt-4">
                <flux:label>CC (comma separated)</flux:label>
                <flux:input wire:model="cc" />
                <flux:error name="cc" />
            </flux:field>
            <flux:field class="mt-4" x-show="open">
                <flux:label>BCC (comma separated)</flux:label>
                <flux:input wire:model="bcc" />
                <flux:error name="bcc" />
            </flux:field>
            <div class="flex justify-end mt-4">
                <flux:button size="sm" variant="ghost" @click="open = !open">
                    <span x-show="!open">Show CC/BCC</span>
                    <span x-show="open">Hide CC/BCC</span>
                </flux:button>
            </div>
        </div>
        <flux:field class="mt-4">
            <flux:editor wire:model="body" label="Body" />
            <flux:error name="body" />
        </flux:field>
        <div class="flex justify-end gap-4">
            <flux:button class="mt-6" wire:click="updatePreview">Update Preview</flux:button>
            <flux:button variant="primary" class="mt-6" wire:click="save">Save Email</flux:button>
        </div>
        <flux:separator class="my-8" />
        <flux:heading level="2" size="lg">Preview</flux:heading>
        <div class="mt-4">
            @if($showPreview)
                <iframe 
                    srcdoc="{!! htmlspecialchars($previewHtml, ENT_QUOTES) !!}" 
                    class="w-full h-[800px] border border-gray-300 rounded bg-white"
                    sandbox="allow-same-origin"
                ></iframe>
            @else
                <div class="p-4 border border-border rounded bg-bg-light text-center text-muted">
                    Click "Update Preview" to see the email preview
                </div>
            @endif
        </div>
    </div>
</x-layouts.app.content>

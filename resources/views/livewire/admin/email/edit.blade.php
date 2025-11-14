<x-layouts.app.content heading="{{ $email->subject }}" subheading="Modify the email details and content." :breadcrumbs="[
    ['label' => 'All Emails', 'href' => route('email.index')],
]">
    <x-slot:actions>
        @if($email->status === 'draft' || $email->status === 'failed' || app()->environment('local'))
            <flux:button wire:click="sendMail" size="sm" wire:confirm="Are you sure you want to send this email?" icon:trailing="paper-airplane">Send Email</flux:button>
        @endif
    </x-slot:actions>
    <div>
        <form wire:submit="save">
            <div class="flex gap-4">
                <flux:field>
                    <flux:label>Status</flux:label>
                    @if($email->status === 'draft')
                        <flux:badge variant="pill" color="blue" icon:trailing="pencil">Draft</flux:badge>
                    @elseif($email->status === 'sent')
                        <flux:badge variant="pill" color="green" icon:trailing="check">Sent</flux:badge>
                    @elseif($email->status === 'failed')
                        <flux:badge variant="pill" color="red" icon:trailing="exclamation-triangle">Failed</flux:badge>
                    @endif
                    <flux:error name="status" />
                </flux:field>
                <flux:field>
                    <flux:label>Reply Status</flux:label>
                    @if($reply_status === 'no_reply')
                        <flux:badge variant="pill" color="gray" icon:trailing="envelope">No Reply</flux:badge>
                    @elseif($reply_status === 'replied')
                        <flux:badge variant="pill" color="green" icon:trailing="inbox-arrow-down">Replied</flux:badge>
                    @endif
                    <flux:error name="reply_status" />
                </flux:field>
                <flux:field>
                    <flux:label>Sent at</flux:label>
                    <p>@userdate($email->sent_at)</p>
                    <flux:error name="sent_at" />
                </flux:field>
            </div>
            <livewire:components.company-picker wire:model="company_id" class="mt-4" />
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
            <div x-data="{ open: {{ $cc || $bcc ? 'true' : 'false' }} }">
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
                <flux:editor class="**:data-[slot=content]:max-h-[1000px]!" wire:model="body" label="Body" />
            </flux:field>
            <div class="flex justify-end gap-4">
                <flux:button type="button" class="mt-6" wire:click="updatePreview">Update Preview</flux:button>
                <flux:button type="submit" variant="primary" class="mt-6">Save Changes</flux:button>
            </div>
        </form>
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

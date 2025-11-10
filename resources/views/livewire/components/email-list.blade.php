<div>
    @if(count($this->emails) === 0)
    <div class="flex">
        <flux:card size="sm">
            <flux:heading class="flex items-center gap-2 justify-between">No Emails <flux:icon.question-mark-circle variant="mini" /></flux:heading>
            <flux:text class="mt-2">No emails found with the current filters.</flux:text>
        </flux:card>
    </div>
    @else
    <flux:table :paginate="$this->emails">
        <flux:table.columns>
            <flux:table.column>Subject</flux:table.column>
            <flux:table.column>Company</flux:table.column>
            <flux:table.column>Recipients</flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'status'" :direction="$sortDirection" wire:click="sort('status')">Status</flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'reply_status'" :direction="$sortDirection" wire:click="sort('reply_status')">Reply Status</flux:table.column>
            <flux:table.column>Parent Email</flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'sent_at'" :direction="$sortDirection" wire:click="sort('sent_at')">Sent At</flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'created_at'" :direction="$sortDirection" wire:click="sort('created_at')">Created At</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @foreach($this->emails as $email)
            <flux:table.row>
                <flux:table.cell><a href="{{ route('email.edit', $email) }}" wire:navigate>{{ $email->subject }}</a></flux:table.cell>
                <flux:table.cell>{{ $email->company->name ?? '' }}</flux:table.cell>
                <flux:table.cell>{{ $email->recipients }}</flux:table.cell>
                <flux:table.cell>
                    @if($email->status === 'draft')
                        <flux:badge size="sm" variant="pill" color="blue" icon="pencil">Draft</flux:badge>
                    @elseif($email->status === 'sent')
                        <flux:badge size="sm" variant="pill" color="green" icon="check">Sent</flux:badge>
                    @elseif($email->status === 'failed')
                        <flux:badge size="sm" variant="pill" color="red" icon="exclamation-triangle">Failed</flux:badge>
                    @endif
                </flux:table.cell>
                <flux:table.cell variant="strong">{{ $email->reply_status }}</flux:table.cell>
                <flux:table.cell>{{ $email->parent_email }}</flux:table.cell>
                <flux:table.cell>
                    @if($email->sent_at)
                        <span title="@userdate($email->sent_at)">@userdaterelative($email->sent_at)</span>
                    @endif
                </flux:table.cell>
                <flux:table.cell>
                    <span title="@userdate($email->created_at)">@userdaterelative($email->created_at)</span>
                </flux:table.cell>
            </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>
    @endif
</div>

<x-layouts.app.content heading="All Contact Forms" subheading="Manage the contact forms submitted through the system.">
    <div class="overflow-x-auto">
        <flux:table :paginate="$this->forms">
            <flux:table.columns>
                <flux:table.column>Name</flux:table.column>
                <flux:table.column sortable :sorted="$sortBy === 'email'" :direction="$sortDirection" wire:click="sort('email')">Email</flux:table.column>
                <flux:table.column sortable :sorted="$sortBy === 'created_at'" :direction="$sortDirection" wire:click="sort('created_at')">Created</flux:table.column>
                <flux:table.column>Actions</flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @foreach ($this->forms as $form)
                    <flux:table.row :key="$form->id">
                        <flux:table.cell>{{ $form->first_name . ' ' . $form->last_name }}</flux:table.cell>
                        <flux:table.cell>{{ $form->email }}</flux:table.cell>
                        <flux:table.cell>{{ $form->created_at }}</flux:table.cell>
                        <flux:table.cell>
                            <a href="{{ route('contactform.detail', $form->id) }}" wire:navigate><flux:button variant="ghost" size="sm" icon="eye" inset="top bottom">View</flux:button></a>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </div>
</x-layouts.app.content>

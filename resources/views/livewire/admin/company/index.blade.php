<x-layouts.app.content heading="All Companies" subheading="Manage the companies in the system.">
    <x-slot:actions>
        <div  class="flex items-center gap-2">
            <flux:input clearable icon="magnifying-glass" size="sm" placeholder="Search" wire:model.live="search" />
            <a href="{{ route('company.create') }}" wire:navigate>
                <flux:button size="sm" icon:trailing="plus">New</flux:button>
            </a>
        </div>
    </x-slot:actions>
    <flux:table :paginate="$this->companies">
        <flux:table.columns>
            <flux:table.column sortable :sorted="$sortBy === 'name'" :direction="$sortDirection" wire:click="sort('name')">Name</flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'customer'" :direction="$sortDirection" wire:click="sort('customer')">Customer</flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'country'" :direction="$sortDirection" wire:click="sort('country')">Country</flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'created_at'" :direction="$sortDirection" wire:click="sort('created_at')">Created At</flux:table.column>
        </flux:table.columns>
        <flux:table.rows>
            @foreach ($this->companies as $company)
                <flux:table.row :key="$company->id">
                    <flux:table.cell><a href="{{ route('company.edit', $company->id) }}" wire:navigate>{{ $company->name }}</a></flux:table.cell>
                    <flux:table.cell>
                        @if($company->customer)
                            <flux:badge size="sm" variant="pill" color="green">Yes</flux:badge>
                        @else
                            <flux:badge size="sm" variant="pill" color="red">No</flux:badge>
                        @endif
                    </flux:table.cell>
                    <flux:table.cell>{{ $company->country }}</flux:table.cell>
                    <flux:table.cell>
                        <span>@userdate($company->created_at)</span>
                    </flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>
</x-layouts.app.content>
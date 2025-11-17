<flux:table :paginate="$this->projects">
    <flux:table.columns>
        <flux:table.column sortable :sorted="$sortBy === 'title'" :direction="$sortDirection" wire:click="sort('title')">Title</flux:table.column>
        <flux:table.column>Company</flux:table.column>
        <flux:table.column sortable :sorted="$sortBy === 'status'" :direction="$sortDirection" wire:click="sort('status')">Status</flux:table.column>
        <flux:table.column sortable :sorted="$sortBy === 'start_date'" :direction="$sortDirection" wire:click="sort('start_date')">Start Date</flux:table.column>
        <flux:table.column sortable :sorted="$sortBy === 'end_date'" :direction="$sortDirection" wire:click="sort('end_date')">End Date</flux:table.column>
    </flux:table.columns>
    <flux:table.rows>
        @foreach ($this->projects as $project)
            <flux:table.row :key="$project->id">
                <flux:table.cell><a href="{{ route('project.edit', $project->id) }}" wire:navigate>{{ $project->title }}</a></flux:table.cell>
                <flux:table.cell>
                    @if($project->company_id)
                    <a href="{{ route('company.edit', $project->company->id) }}" wire:navigate>{{ $project->company->name }}</a>
                    @else
                        -
                    @endif
                </flux:table.cell>
                <flux:table.cell>
                    <flux:badge size="sm" variant="pill" color="{{ \App\Enums\ProjectStatus::from($project->status)->color() }}">
                        {{ \App\Enums\ProjectStatus::from($project->status)->label() }}
                    </flux:badge>
                </flux:table.cell>
                <flux:table.cell>
                    <span>{{ $project->start_date->format('d.m.Y') }}</span>
                </flux:table.cell>
                <flux:table.cell>
                    <span>{{ $project->end_date->format('d.m.Y') }}</span>
                </flux:table.cell>
            </flux:table.row>
        @endforeach
    </flux:table.rows>
</flux:table>
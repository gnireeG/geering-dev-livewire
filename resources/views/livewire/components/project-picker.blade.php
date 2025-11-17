<div class="flex gap-2 items-end">
    <flux:field class="{{ $class ?? '' }} grow">
        <flux:label>Project</flux:label>
        <flux:select wire:model.live="project_id" variant="listbox" searchable clearable>
            @foreach($this->projects as $project)
                <flux:select.option value="{{ $project->id }}">{{ $project->title }}</flux:select.option>
            @endforeach
        </flux:select>
        <flux:error name="project_id" />
    </flux:field>
    @if($project_id)<a href="{{ route('project.edit', $project_id) }}" wire:navigate><flux:button><flux:icon.eye /></flux:button></a>@endif
</div>
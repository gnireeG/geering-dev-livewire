<div>
    <flux:heading size="xl" level="1">Create Portfolio</flux:heading>
    
    <form wire:submit.prevent="create">
        <flux:field>
            <flux:label>Title</flux:label>
            <flux:input wire:model="title" />
            <flux:error name="title" />
        </flux:field>
        
        <flux:field class="mt-4">
            <flux:label>Description</flux:label>
            <flux:textarea wire:model="description" />
            <flux:error name="description" />
        </flux:field>
        
        <flux:button class="mt-8" type="submit">Create Portfolio</flux:button>
    </form>
</div>
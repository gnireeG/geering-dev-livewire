<div x-data="{tab:'general'}">
    <section class="flex justify-between items-center">
        <flux:heading level="1" size="xl">Portfolio</flux:heading>
        @if($portfolio)
        <flux:radio.group x-model="tab" variant="segmented">
                <flux:radio value="general" label="General" />
                <flux:radio value="media" label="Media" />
            </flux:radio.group>
        @endif
    </section>
    <flux:separator class="my-8" />
    <div>
        <div x-show="tab === 'general'">
            @if($portfolio)
                <form wire:submit.prevent="update">
            @else
                <form wire:submit.prevent="create">
            @endif
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
                <div class="flex justify-end gap-2">
                    <a href="{{ route('portfolio.index') }}" wire:navigate><flux:button variant="ghost" class="mt-8" type="button">Cancel</flux:button></a>
                    <flux:button variant="primary" class="mt-8" type="submit">Save</flux:button>
                </div>
            </form>
            @if($portfolio)
            <flux:separator text="preview" class="my-8" />
            <x-markdown class="markdown">
                {!! $portfolio->description ?? 'No description available.' !!}
            </x-markdown>
            @endif
        </div>
        @if($portfolio)
        <div x-show="tab === 'media'">
            <livewire:media-library
                    collection="images"
                    :model="$portfolio"
                    wire:model="images"
                    rules="mimes:jpeg,png"
                    fields-view="components.portfolio.partials.formfields"
                />
            <div class="flex justify-end gap-2">
                <a href="{{ route('portfolio.index') }}" wire:navigate><flux:button variant="ghost" class="mt-8" type="button">Cancel</flux:button></a>
                @if($portfolio)<flux:button variant="primary" class="mt-8" wire:click="update">Save</flux:button>@endif
                @if(!$portfolio)<flux:button variant="primary" class="mt-8" wire:click="create">Create</flux:button>@endif
            </div>
        </div>
        @endif
    </div>
</div>
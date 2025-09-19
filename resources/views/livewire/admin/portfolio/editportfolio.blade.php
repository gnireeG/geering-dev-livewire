<div>
    <section class="flex justify-between items-center">
        <flux:heading level="1" size="xl">Portfolio</flux:heading>
    </section>
    <flux:separator class="my-8" />
    <div>
        <div>
            <div class="flex justify-end">
                <flux:field variant="inline" class="flex items-center gap-2">
                    <flux:checkbox wire:model="published" />
                    <flux:label>Published</flux:label>
                    <flux:error name="published" />
                </flux:field>
            </div>
            <flux:field>
                <flux:label>Title</flux:label>
                <flux:input wire:model="title" />
                <flux:error name="title" />
            </flux:field>
            <flux:field class="mt-4">
                <flux:label>Short Description</flux:label>
                <flux:textarea wire:model="shortdesc" />
                <flux:error name="shortdesc" />
            </flux:field>
            <flux:field class="mt-4">
                <flux:label>Content (MD)</flux:label>
                <flux:textarea wire:model="description" />
                <flux:error name="description" />
            </flux:field>
            
            
            @if($portfolio)

            <flux:separator class="my-8" />
            <div x-data="{
            tags: $wire.tags,
            addTag: function(){
                if(this.tag.trim() !== ''){
                    const exists = this.tags.includes(this.tag.trim());
                    if(!exists){
                        this.tags.push(this.tag.trim());
                        this.tag = '';
                    }
                }
            },
            tag: ''
            }">
                <flux:field>
                    <flux:label>Tags</flux:label>
                    <flux:input placeholder="Enter a tag and hit enter" @keyup.enter="addTag()" x-model="tag" />
                </flux:field>
                <div class="flex gap-2 mt-4">
                    <template x-for="(tag, index) in tags">
                        <div class="bg-white dark:bg-white/10 rounded-lg py-2 ps-3 pe-3 flex gap-2 text-base border-zinc-200 dark:border-white/10 border">
                            <p x-text="tag"></p>
                            <button type="button" class="cursor-pointer" @click="tags.splice(index, 1)"><flux:icon.x-mark variant="micro" /></button>
                        </div>
                    </template>
                </div>
            </div>
            <flux:separator class="my-8" />
            <div class="mb-8">
                <livewire:media-library
                    collection="images"
                    :model="$portfolio"
                    wire:model="images"
                    rules="mimes:jpeg,png"
                    fields-view="components.portfolio.partials.formfields"
                />
            </div>
            <div>
                <flux:label>Banner</flux:label>
                <livewire:media-library
                    collection="banner"
                    :model="$portfolio"
                    wire:model="banner"
                    rules="mimes:jpeg,png"
                />
            </div>
            @endif
            <div class="flex justify-end gap-2">
                <a href="{{ route('portfolio.index') }}" wire:navigate><flux:button variant="ghost" class="mt-8" type="button">Cancel</flux:button></a>
                @if($portfolio)<flux:button variant="primary" class="mt-8" wire:click="update">Save</flux:button>@endif
                @if(!$portfolio)<flux:button variant="primary" class="mt-8" wire:click="create">Save</flux:button>@endif
            </div>
            @if($portfolio)
            
            <flux:separator text="preview" class="my-8" />
            <x-markdown class="markdown">
                {!! $portfolio->description ?? 'No description available.' !!}
            </x-markdown>
            @endif
        </div>
    </div>
</div>
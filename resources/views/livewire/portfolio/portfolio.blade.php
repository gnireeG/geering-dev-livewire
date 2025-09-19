<x-container x-data="{showTags: {{count($selectedTags)}} > 0 ? true : $persist(false)}">
    <div class="mb-8">
        <h1>Portfolio</h1>
        <p class="text-muted">{{ __('portfolio.intro')}}</p>
        @if(config('features.portfolio.tags') && count($tags) > 0)
        <div class="mt-8">
            <button x-cloak x-show="!showTags" @click="showTags = !showTags" class="flex gap-2 cursor-pointer items-center hover:text-primary">{{__('portfolio.show_tags')}}<flux:icon.chevron-down variant="mini" /></button>
            <button x-cloak x-show="showTags" @click="showTags = !showTags" class="flex gap-2 cursor-pointer items-center hover:text-primary">{{__('portfolio.hide_tags')}}<flux:icon.chevron-up variant="mini" /></button>
            <div class="flex gap-2 flex-wrap mt-4" x-show="showTags" x-transition>
                @foreach($tags as $tag)
                    <button 
                        @if(in_array($tag->name, $selectedTags))
                        wire:click="removeTag('{{$tag->name}}')"
                        @else
                        wire:click="addTag('{{$tag->name}}')"
                        @endif
                        class="cursor-pointer hover:text-primary bg-bg-light p-1 rounded-lg {{ in_array($tag->name, $selectedTags) ? 'text-primary' : '' }}"
                    >#{{$tag->name}}</button>
                @endforeach
                @if(count($tags) > 0 && count($selectedTags) > 0)
                    <button wire:click="resetTags" class="cursor-pointer hover:text-primary bg-bg-light p-1 rounded-lg flex gap-1 items-center"><flux:icon.x-mark variant="micro"/> {{ __('portfolio.show_all') }}</button>
                @endif
            </div>
        </div>
        @endif
    </div>
    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
        @foreach($this->portfolios as $portfolio)
            <x-portfolio.card :portfolio="$portfolio" />
        @endforeach
    </div>
</x-container>
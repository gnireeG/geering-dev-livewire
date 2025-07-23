<x-container x-data="{showTags: $persist(false)}">
    <div class="mb-8">
        <h1>Portfolio</h1>
        <p class="text-muted">{{ __('portfolio.intro')}}</p>
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
            </div>
        </div>
    </div>
    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
        @foreach($this->portfolios as $portfolio)
            <a wire:navigate.hover
            href="{{ route('portfolio.detail', ['slug' => $portfolio->slug]) }}"
            class="cursor-pointer bg-bg-light rounded-t-2xl rounded-b-2xl group">
                <div class="w-full aspect-video overflow-hidden rounded-t-2xl">
                    <img
                    @if($portfolio->getFirstMedia('images'))
                        src="{{ $portfolio->getFirstMediaUrl('images', 'thumb') }}"
                        alt="{{ $portfolio->getFirstMedia('images')->custom_properties['alt_tag'] ?? 'Titelbild Portfolio' }}"
                    @else
                        src="{{ asset('placeholder-'.rand(1, 5).'.jpg') }}"
                        alt="{{ $portfolio->title }}"
                    @endif
                    class="w-full aspect-video object-cover rounded-t-2xl mb-4 saturate-50 group-hover:saturate-100 transition-all group-hover:scale-120 duration-500"
                    >
                </div>
                <div class="p-4 overflow-hidden">
                    <h4 class="text-primary/80 group-hover:text-primary transition-colors font-bold text-lg">{{ $portfolio->title }}</h4>
                    <p class="text-base">{{ $portfolio->shortdesc }}</p>
                    <div class="text-sm flex gap-1 mt-4 flex-wrap" x-cloak x-show="showTags" x-transition >
                        @foreach($portfolio->tags as $tag)
                            <button class="cursor-pointer hover:text-primary bg-bg p-1 rounded-lg" @click="event.stopPropagation();">#{{$tag->name}}</button>
                        @endforeach
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</x-container>
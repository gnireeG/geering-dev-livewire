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
        @if(config('features.portfolio.tags'))
        <div class="text-sm flex gap-1 mt-4 flex-wrap" x-cloak x-show="showTags" x-transition >
            @foreach($portfolio->tags as $tag)
                <p class="bg-bg p-1 rounded-lg" @click="event.stopPropagation();">#{{$tag->name}}</p>
            @endforeach
        </div>
        @endif
    </div>
</a>
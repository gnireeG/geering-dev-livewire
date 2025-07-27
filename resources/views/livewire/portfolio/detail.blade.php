<div>
    @if(count($this->banner) > 0)
    <div class="w-full flex justify-center h-40 md:h-64 lg:h-96 relative" >
        <div class="h-full w-full max-w-[2560px] bg-cover "
        style="background-image: url('{{ $portfolio->getFirstMediaUrl('banner', 'banner') }}')">
        </div>
    </div>
    @endif
    <x-container class="mt-8">
        <div class="flex justify-between">
            <x-backlink route="portfolio" :name="__('portfolio.back')" />
            <div class="flex gap-2 justify-center items-start">
                @foreach($portfolio->tags as $tag)
                    <a wire:navigate href="{{ route('portfolio') . '?tags=' . $tag->slug }}" class=" hover:text-primary bg-bg-light p-1 rounded-lg">#{{ $tag->name }}</a>
                @endforeach
            </div>
        </div>
        <h1>{{ $portfolio->title }}</h1>
        <p class="mb-8">{{ $portfolio->shortdesc }}</p>
        @if(count($this->gallery) > 0)<x-carousel :media="$this->gallery" class="mb-8" />@endif
        <x-markdown class="markdown">{!! $portfolio->description !!}</x-markdown>
    </x-container>
</div>
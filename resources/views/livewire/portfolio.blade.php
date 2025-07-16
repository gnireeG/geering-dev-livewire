<div class="flex justify-center">
    <div class="container">
        <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
            @foreach($portfolios as $portfolio)
                <a wire:navigate.hover
                href="{{ route('portfolio.detail', ['portfolio' => $portfolio->slug]) }}"
                class="cursor-pointer bg-bg-light rounded-t-2xl rounded-b-2xl group">
                    <div class="w-full aspect-video overflow-hidden rounded-t-2xl">
                        @if($portfolio->getFirstMedia('images'))
                            <img src="{{ $portfolio->getFirstMediaUrl('images', 'thumb') }}"
                            alt="{{ $portfolio->getFirstMedia('images')->custom_properties['alt_tag'] }}"
                            class="w-full aspect-video object-cover rounded-t-2xl mb-4 saturate-50 group-hover:saturate-100 transition-all group-hover:scale-120 duration-500">
                        @else
                            <img src="{{ 'https://placehold.co/304x171?text='. $portfolio->title.'&font=Playfair Display' }}"
                            alt="{{ $portfolio->title }}"
                            class="w-full aspect-video object-cover rounded-t-2xl mb-4 saturate-50 group-hover:saturate-100 transition-all group-hover:scale-120 duration-500">
                        @endif
                    </div>
                    <div class="p-4 overflow-hidden">
                        <h3>{{ $portfolio->title }}</h3>
                        <p>{{ $portfolio->shortdesc }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>

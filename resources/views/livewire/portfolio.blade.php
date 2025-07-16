<div class="flex justify-center">
    <div class="container">
        @foreach($portfolios as $portfolio)
            <div class="portfolio-item">
                <h2 class="text-2xl font-bold">{{ $portfolio->title }}</h2>
                <p class="text-gray-700">{{ $portfolio->description }}</p>
                <p>slug?{{$portfolio->slug}}</p>
                <a wire:navigate href="{{ route('portfolio.detail', ['portfolio' => $portfolio->slug]) }}" class="text-blue-500 hover:underline">View Details</a>
            </div>
        @endforeach
    </div>
</div>

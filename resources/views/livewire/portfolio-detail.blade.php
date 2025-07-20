<div class="flex justify-center">
    <div class="container">
        <x-backlink route="portfolio" :name="__('portfolio.back')" />
        <h1>{{ $portfolio->title }}</h1>
        <x-markdown class="markdown">{!! $portfolio->description !!}</x-markdown>
    </div>
</div>

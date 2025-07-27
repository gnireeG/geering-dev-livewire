<div {{ $attributes }} x-data="{
        show: 0,
        next(){
            this.show = (this.show + 1) % {{ count($media) }};
        },
        prev(){
            this.show = (this.show - 1 + {{ count($media) }}) % {{ count($media) }};
        },
        fullscreen: false,
        toggleFullscreen(){
            this.fullscreen = !this.fullscreen;
            if(this.fullscreen) {
                document.documentElement.classList.add('overflow-hidden');
            } else {
                document.documentElement.classList.remove('overflow-hidden');
            }
        }
    }">
    <div class="flex justify-center mx-auto group aspect-video max-h-96 overflow-hidden relative h-full">
        @foreach($media as $index => $image)
            <div class="size-full relative" x-show="show === {{ $index }}" x-cloak>
                <img class="object-contain size-full cursor-zoom-in" src="{{ $image->getUrl() }}" alt="{{ $image->getCustomProperty('alt_tag') }}" @click="toggleFullscreen" />
                <button class="absolute top-0 h-full w-12 flex justify-center items-center cursor-pointer left-0" @click="prev"><flux:icon.chevron-left /></button>
                <button class="absolute top-0 h-full w-12 flex justify-center items-center cursor-pointer right-0" @click="next"><flux:icon.chevron-right /></button>
            </div>
        @endforeach
    </div>
    <div class="flex justify-center">
        @foreach($media as $index => $image)
                <p x-show="show === {{ $index }}" x-cloak class="text-center py-2">{{ $image->getCustomProperty('alt_tag') }}</p>
        @endforeach
    </div>
    <div class="flex justify-center mt-2" aria-hidden>
        @foreach($media as $index => $image)
            <button class="w-3 h-3 rounded-full mx-1 transition-colors cursor-pointer"
            :class="show === {{ $index }} ? 'bg-primary' : 'bg-accent/50'"
            @click="show = {{ $index }}"></button>
        @endforeach
    </div>
    <div class="fixed h-screen w-screen inset-0 z-40 bg-bg-light/95"
    x-show="fullscreen"
    x-cloak
    x-transition
    aria-hidden>
        <div class="flex items-center justify-center h-full">
            <div class="max-w-[90vw] max-h-[90vh] overflow-hidden">
                @foreach($media as $index => $image)
                    <img class="object-contain size-full cursor-zoom-out" @click="toggleFullscreen" src="{{ $image->getUrl() }}" alt="{{ $image->getCustomProperty('alt_tag') }}" x-show="show === {{ $index }}" />
                @endforeach
                <button class="transition-colors absolute top-0 h-full w-16 flex justify-center items-center cursor-pointer left-0" @click.stop="prev"><flux:icon.chevron-left /></button>
                <button class="transition-colors absolute top-0 h-full w-16 flex justify-center items-center cursor-pointer right-0" @click.stop="next"><flux:icon.chevron-right /></button>
                <button class="transition-colors absolute top-0 flex justify-center items-center cursor-pointer right-0 p-4" @click.stop="toggleFullscreen"><flux:icon.x-mark /></button>
                <div class="absolute bottom-0 left-0 w-full bg-bg flex justify-center p-4 pr-12">
                    @foreach($media as $index => $image)
                        <p x-show="show === {{ $index }}" class="text-center">{{ $image->getCustomProperty('alt_tag') }}</p>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex justify-center absolute bottom-4 w-full">
        
        </div>
    </div>
</div>
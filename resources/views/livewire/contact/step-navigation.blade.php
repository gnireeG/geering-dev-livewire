<div>
    <div class="mb-8 hidden md:block">
        {{-- <button class="mb-8" wire:click="debug">Debug</button> --}}
        <ol class="grid grid-cols-3 bg-bg-light rounded-full text-sm">
            @foreach($steps as $index => $step)
                <li 
                    class="relative text-center p-2 first:rounded-l-full last:rounded-r-full
                    {{ $step->status->value == "current" || $step->status->value == "previous" ? 'bg-bg-light-inverted text-bg' : '' }}
                    {{ $step->status->value == "current" && !$step->last ? 'contact-step-current' : '' }}"
                >{{$index + 1 .'. '. $step->label }}</li>
            @endforeach
        </ol>
    </div>
    <div class="md:hidden mb-8">
        <div class="flex gap-4 items-center">
            <?php
                $current = 0;
                $percentage = 0;
                foreach($steps as $index => $step) {
                    if($step->status->value == "current") {
                        $current = $index + 1;
                        $percentage = ($index + 1) / (count($steps)) * 100;
                        break;
                    }
                }
            ?>
            <div class="progress-bar text-sm">{{ $current }} / {{ count($steps) }}</div>
            <div class="flex flex-col gap-2">
                <p class="font-bold">{{ $steps[$current - 1]->label }}</p>
                @if($current < count($steps))
                    <p class="text-xs">{{ __('general.next_step') }}: {{ $steps[$current]->label }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
<style>
.progress-bar {
  display: flex;
  justify-content: center;
  align-items: center;

  width: 50px;
  height: 50px;
  border-radius: 50%;
  background: 
    radial-gradient(closest-side, var(--color-bg-light) 79%, transparent 80% 100%),
    conic-gradient(green {{ $percentage }}%, transparent 0);    
}
</style>
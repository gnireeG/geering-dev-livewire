<div class="mb-8">
    <button class="mb-8" wire:click="debug">Debug</button>
    <ol class="grid grid-cols-3 bg-bg-light rounded-full text-sm">
        @foreach($steps as $index => $step)
            <li 
                class="relative text-center p-2 first:rounded-l-full last:rounded-r-full
                 {{ $step->status->value == "current" || $step->status->value == "previous" ? 'bg-bg-light-inverted text-bg' : '' }}
                 {{ $step->status->value == "current" && !$step->last ? 'contact-step-current' : '' }}"
                wire:click="showStep('{{ $step->stepName }}')"
            >{{$index + 1 .'. '. $step->label }}</li>
        @endforeach
    </ol>
</div>

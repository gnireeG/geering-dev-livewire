@php
    $needs = json_decode($contactform['needs'], true) ?? [];
    $class = 'p-4 bg-zinc-50 dark:bg-zinc-700 rounded-lg';
@endphp

<div class="space-y-8">

    {{-- Header --}}
    <div class="{{ $class }}">
        <div class="flex items-center justify-between">
            <flux:heading size="lg">
                Contact Request #{{ $contactform['id'] }}
            </flux:heading>
            <span class="text-sm text-muted-foreground">
                Received: {{ $contactform['created_at']->format('d.m.Y H:i') }}
            </span>
        </div>
    </div>

    {{-- Contact Info --}}
    <div class="{{ $class }}" x-data="dropdown">
        <flux:heading size="md" class="mb-4 cursor-pointer" @click="toggle">Contact Information</flux:heading>

        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6" x-show="open">
            <div>
                <dt class="text-sm font-medium text-muted-foreground">First Name</dt>
                <dd>{{ $contactform['first_name'] }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-muted-foreground">Last Name</dt>
                <dd>{{ $contactform['last_name'] }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-muted-foreground">Email</dt>
                <dd class="flex items-center gap-2">
                    {{ $contactform['email'] }}
                </dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-muted-foreground">Phone</dt>
                <dd>{{ $contactform['phone'] }}</dd>
            </div>
        </dl>
    </div>

    {{-- Requested Services --}}
    <div class="{{ $class }}">
        <flux:heading size="md" class="mb-4">Requested Services</flux:heading>

        <div class="flex flex-wrap gap-2">
            @foreach($needs as $key => $value)
                @php $active = filter_var($value, FILTER_VALIDATE_BOOLEAN); @endphp
                <flux:badge color="{{ $active ? 'green' : 'red' }}">
                    @if($active)
                        <flux:icon.check class="w-4 h-4 mr-1" />
                    @endif
                    {{ ucfirst(str_replace('_', ' ', $key)) }}
                </flux:badge>
            @endforeach

            @if(!empty($contactform['needs_other']))
                <flux:badge variant="default">
                    Other: {{ $contactform['needs_other'] }}
                </flux:badge>
            @endif
        </div>
    </div>

    {{-- Website / Webshop Info --}}
    <div class="{{ $class }}" x-data="dropdown">
        <flux:heading size="md" class="mb-4 cursor-pointer" @click="toggle">Website / Webshop</flux:heading>

        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6" x-show="open">
            <div>
                <dt class="text-sm font-medium text-muted-foreground">Has Website?</dt>
                <dd class="flex items-center">
                    @if(filter_var($contactform['has_website'], FILTER_VALIDATE_BOOLEAN))
                        <flux:icon.check class="w-4 h-4 mr-1 text-green-600" /> Yes
                    @else
                        <flux:icon.x-mark class="w-4 h-4 mr-1 text-red-600" /> No
                    @endif
                </dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-muted-foreground">Existing Website</dt>
                <dd>{{ $contactform['existing_website'] ?: '—' }}</dd>
            </div>
            <div class="md:col-span-2">
                <dt class="text-sm font-medium text-muted-foreground">Likes About Websites</dt>
                <dd>{{ $contactform['website_likes'] ?: '—' }}</dd>
            </div>
            <div class="md:col-span-2">
                <dt class="text-sm font-medium text-muted-foreground">Dislikes About Websites</dt>
                <dd>{{ $contactform['website_dislikes'] ?: '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-muted-foreground">Webshop Products</dt>
                <dd>{{ $contactform['webshop_products'] ?: '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-muted-foreground">Webshop Location</dt>
                <dd>{{ $contactform['webshop_location'] ?: '—' }}</dd>
            </div>
        </dl>
    </div>

    {{-- Additional Notes --}}
    <div class="{{ $class }}">
        <flux:heading size="md" class="mb-4">Additional Notes</flux:heading>
        <p>{{ $contactform['description'] ?: '—' }}</p>
    </div>
    <div>
        @php
            dump($contactform->toArray());
        @endphp
    </div>

</div>

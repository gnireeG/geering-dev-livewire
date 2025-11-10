<x-layouts.app.content heading="All Portfolios" subheading="Manage the portfolios in the system.">
    <x-slot:actions>
        <a wire:navigate href="{{ route('portfolio.create') }}">
            <flux:button icon:trailing="plus" class="cursor-pointer" size="sm">New</flux:button>
        </a>
    </x-slot:actions>
    <div class="overflow-x-auto">
        <table>
            <thead>
                <tr>
                    <th class="p-2" align="left">&nbsp;</th>
                    <th class="p-2" align="left">Title</th>
                    <th class="p-2" align="left">Short Description</th>
                    <th class="p-2" align="left">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($portfolios as $p)
                <tr class="hover:bg-zinc-50 hover:dark:bg-zinc-700">
                    <td class="p-2" wire:click="toggleStatus({{ $p->id }})" style="cursor: pointer;">
                        @if($p->published)
                            <flux:icon.eye class="text-green-500" />
                        @else
                            <flux:icon.eye-slash class="text-red-500" />
                        @endif
                    </td>
                    <td class="p-2"><a wire:navigate href="{{ route('portfolio.edit', ['id' => $p->id]) }}">{{$p->title}}</a></td>
                    <td class="p-2"><a wire:navigate href="{{ route('portfolio.edit', ['id' => $p->id]) }}">{{$p->shortdesc}}</a></td>
                    <td class="p-2 flex gap-2">
                        <a href="{{ route('portfolio.edit', ['id' => $p->id]) }}" wire:navigate><flux:button size="sm" icon="pencil-square" /></a>
                        <flux:button size="sm" variant="danger" wire:click="remove({{$p->id}})" wire:confirm="Are you sure you want to delete '{{ $p->title }}'" icon="trash" />
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app.content>

<div>
    <section class="flex justify-between items-center">
        <flux:heading level="1" size="xl">Portfolio</flux:heading>
        <a wire:navigate href="{{ route('portfolio.create') }}">
            <flux:button icon:trailing="plus" class="cursor-pointer">Create Portfolio</flux:button>
        </a>
    </section>
    <flux:separator class="my-8" />
    <div class="overflow-x-auto">
        <table>
            <thead>
                <tr>
                    <th class="p-2" align="left">Title</th>
                    <th class="p-2" align="left">Short Description</th>
                    <th class="p-2" align="left">Description</th>
                    <th class="p-2" align="left">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($portfolios as $p)
                <tr class="hover:bg-zinc-50 hover:dark:bg-zinc-700">
                    <td class="p-2">{{$p->title}}</td>
                    <td class="p-2">{{$p->shortdesc}}</td>
                    <td class="p-2">{{$p->description}}</td>
                    <td class="p-2 flex gap-2">
                        <a href="{{ route('portfolio.edit', ['id' => $p->id]) }}" wire:navigate><flux:button size="sm" icon="pencil-square" /></a>
                        <flux:button size="sm" variant="danger" wire:click="remove({{$p->id}})" wire:confirm="Are you sure you want to delete '{{ $p->title }}'" icon="trash" />
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

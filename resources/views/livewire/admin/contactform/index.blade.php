<div>
    <section class="flex justify-between items-center">
        <flux:heading level="1" size="xl">Contact forms</flux:heading>
    </section>
    <flux:separator class="my-8" />
    <div class="overflow-x-auto">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contactForms as $contactForm)
                <tr>
                    <td>{{ $contactForm->first_name.' '.$contactForm->last_name }}</td>
                    <td>{{ $contactForm->email }}</td>
                    <td>{{ $contactForm->phone }}</td>
                    <td>{{ $contactForm->created_at->format('M d, Y') }}</td>
                    <td>
                        <a wire:navigate.hover href="{{ route('contactform.detail', $contactForm->id) }}" class="text-blue-500 hover:underline">View</a>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

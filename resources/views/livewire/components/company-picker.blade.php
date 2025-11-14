<flux:field class="{{ $class ?? '' }}">
    <flux:label>Company</flux:label>
    <flux:select wire:model="company_id" variant="listbox" searchable>
        @foreach($companies as $company)
            <flux:select.option value="{{ $company->id }}">{{ $company->name }}</flux:select.option>
        @endforeach
    </flux:select>
    <flux:error name="company_id" />
</flux:field>

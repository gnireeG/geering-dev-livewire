<div class="flex gap-2 items-end">
    <flux:field class="{{ $class ?? '' }} grow">
        <flux:label>Company</flux:label>
        <flux:select wire:model.live="company_id" variant="listbox" searchable clearable @change="$dispatch('company-changed')">
            @foreach($companies as $company)
                <flux:select.option value="{{ $company->id }}">{{ $company->name }}</flux:select.option>
            @endforeach
        </flux:select>
        <flux:error name="company_id" />
    </flux:field>
    @if($company_id)<a href="{{ route('company.edit', $company_id) }}" wire:navigate><flux:button><flux:icon.eye /></flux:button></a>@endif
</div>
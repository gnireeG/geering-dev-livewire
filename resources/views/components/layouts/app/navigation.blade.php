<div>
    <flux:navlist variant="outline">
        <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>Home</flux:navlist.item>
        <flux:navlist.group heading="Website" class="grid" expandable :expanded="false">
            <flux:navlist.item icon="trophy" :href="route('portfolio.index')" :current="request()->routeIs('portfolio.index')" wire:navigate>Portfolio</flux:navlist.item>
            <flux:navlist.item icon="document-text" :href="route('contactform.index')" :current="request()->routeIs('contactform.index')" wire:navigate>Contactform</flux:navlist.item>
        </flux:navlist.group>
        <flux:navlist.group heading="Emails" class="grid">
            <flux:navlist.item icon="inbox-stack" :href="route('email.index')" :current="request()->routeIs('email.index')" wire:navigate>All Emails</flux:navlist.item>
            <flux:navlist.item icon="plus" :href="route('email.create')" :current="request()->routeIs('email.create')" wire:navigate>Write Email</flux:navlist.item>
        </flux:navlist.group>
        <flux:navlist.group heading="Companies" class="grid">
            <flux:navlist.item icon="building-office-2" :href="route('company.index')" :current="request()->routeIs('company.index')" wire:navigate>All Companies</flux:navlist.item>
            <flux:navlist.item icon="building-office-2" :href="route('company.customers')" :current="request()->routeIs('company.customers')" wire:navigate>Customers</flux:navlist.item>
            <flux:navlist.item icon="plus" :href="route('company.create')" :current="request()->routeIs('company.create')" wire:navigate>New Company</flux:navlist.item>
        </flux:navlist.group>
        <flux:navlist.group heading="Meetings" class="grid">
            <flux:navlist.item icon="calendar" :href="route('meeting.calendar')" :current="request()->routeIs('meeting.calendar')" wire:navigate>Calendar</flux:navlist.item>
        </flux:navlist.group>
        <flux:navlist.group heading="Projects" class="grid">
            <flux:navlist.item icon="folder-open" :href="route('project.index')" :current="request()->routeIs('project.index')" wire:navigate>All Projects</flux:navlist.item>
            <flux:navlist.item icon="calendar-days" :href="route('project.planning')" :current="request()->routeIs('project.planning')" wire:navigate>Planning</flux:navlist.item>
            <flux:navlist.item icon="folder" :href="route('project.open')" :current="request()->routeIs('project.open')" wire:navigate>Open</flux:navlist.item>
            <flux:navlist.item icon="check-circle" :href="route('project.completed')" :current="request()->routeIs('project.completed')" wire:navigate>Completed</flux:navlist.item>
        </flux:navlist.group>
    </flux:navlist>
</div>





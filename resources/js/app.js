if(document.documentElement.getAttribute('data-session-theme') !== null) {

    const html = document.documentElement
    const sessionTheme = html.getAttribute('data-session-theme') ? html.getAttribute('data-session-theme') === "true" : false;

    const theme = {
        value: html.getAttribute('data-theme') || 'light',
    }

    async function postTheme(){
        fetch('/theme', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ theme: theme.value })
        })
    }

    if (!sessionTheme) {
        const prefers = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
        theme.value = prefers
        applyTheme()
        postTheme()
    }

    function applyTheme() {
        html.setAttribute('data-theme', theme.value)
        html.classList.remove('light', 'dark')
        html.classList.add(theme.value)
        document.querySelector('#theme-toggle')?.setAttribute('aria-label', theme.value)
    }

    function onClick(){
        console.log('Theme toggle clicked')
        theme.value = theme.value === 'light' ? 'dark' : 'light'
        applyTheme()
        postTheme()
    }

    function onLoad(){
        const themeToggle = document.querySelectorAll('.theme-toggle')
        if (!themeToggle) return

        // Add click listener
        themeToggle.forEach(toggle => {
            toggle.addEventListener('click', onClick)
        })
    }

    document.addEventListener('DOMContentLoaded', onLoad)

    document.addEventListener('livewire:navigated', onLoad)
}


document.addEventListener('alpine:init', () => {
    Alpine.store('nav', {
        open: false,
        toggle() {
            this.open = !this.open
        },
        close() {
            this.open = false
        }
    })
    Alpine.data('dropdown', () => ({
        open: false,

        toggle() {
            this.open = ! this.open
        },
    }))
})

document.addEventListener('livewire:navigated', () => {
    
    // Close the nav
    setTimeout(() => {
        Alpine.store('nav').close()
    }, 10)
})

document.addEventListener('livewire:navigate', preventUnsavedChangesLoss)

window.addEventListener('beforeunload', preventUnsavedChangesLoss)

function preventUnsavedChangesLoss(e) {
    const dirtyForm = document.querySelector('form.unsaved-changes')
    if (dirtyForm) {
        if (!confirm('You have unsaved changes. Are you sure you want to leave this page?')) {
            e.preventDefault()
        }
    }
}

window.addEventListener('beforeunload', preventPageUnloadTimerRunning)

function preventPageUnloadTimerRunning(e){
    const timer = document.querySelector('#timetracker')
    const active = timer?.getAttribute('data-timetracker-active') === 'true'
    if(active){
        e.preventDefault()
        e.returnValue = 'A time tracking session is running. Are you sure you want to leave this page?'
        return 'A time tracking session is running. Are you sure you want to leave this page?'
    }
}
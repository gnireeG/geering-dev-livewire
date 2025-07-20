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
        const themeToggle = document.querySelector('#theme-toggle')
        if (!themeToggle) return

        // Add click listener
        themeToggle.addEventListener('click', onClick)
    }

    document.addEventListener('DOMContentLoaded', onLoad)

    document.addEventListener('livewire:navigated', onLoad)
}


document.addEventListener('alpine:init', () => {
    Alpine.store('navOpen', false)
})
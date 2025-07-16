
const storageKey = 'theme-preference'

const logoLight = document.querySelector('#logo-light'),
  logoDark = document.querySelector('#logo-dark')

const onClick = () => {
  // flip current value
  theme.value = theme.value === 'light'
    ? 'dark'
    : 'light'

  setPreference()
}

const getColorPreference = () => {
  if (localStorage.getItem(storageKey))
    return localStorage.getItem(storageKey)
  else
    return window.matchMedia('(prefers-color-scheme: dark)').matches
      ? 'dark'
      : 'light'
}

const setPreference = () => {
  localStorage.setItem(storageKey, theme.value)
  reflectPreference()
}

const reflectPreference = () => {
  /* document.firstElementChild
    .setAttribute('data-theme', theme.value)

  document
    .querySelector('#theme-toggle')
    ?.setAttribute('aria-label', theme.value) */
  document.querySelector('html').classList.remove('light', 'dark')
  document.querySelector('html').classList.add(theme.value)
}

const theme = {
  value: getColorPreference(),
}

// set early so no page flashes / CSS is made aware
reflectPreference()



const onloadFn = () => {
  const themeToggle = document.querySelector('#theme-toggle')
  if (!themeToggle) return
  // set on load so screen readers can see latest value on the button
  reflectPreference()

  // now this script can find and listen for clicks on the control
  themeToggle.addEventListener('click', onClick)
}

// sync with system changes
window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', ({ matches: isDark }) => {
    theme.value = isDark ? 'dark' : 'light'
    setPreference()
  })

window.onload = onloadFn

window.addEventListener('livewire:navigated', () => {
  onloadFn()
})
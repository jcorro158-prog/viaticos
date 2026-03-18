import.meta.glob([
    '../img/**',
]);

const syncFluxAppearance = () => {
    const savedAppearance = window.localStorage.getItem('flux.appearance') || 'system';
    const root = document.documentElement;

    if (savedAppearance === 'dark') {
        root.classList.add('dark');
        return;
    }

    if (savedAppearance === 'light') {
        root.classList.remove('dark');
        return;
    }

    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

    root.classList.toggle('dark', prefersDark);
};

document.addEventListener('DOMContentLoaded', syncFluxAppearance);
document.addEventListener('livewire:navigated', syncFluxAppearance);

window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
    if (! window.localStorage.getItem('flux.appearance')) {
        syncFluxAppearance();
    }
});
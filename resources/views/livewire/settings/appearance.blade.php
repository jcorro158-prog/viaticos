<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Appearance')" :subheading=" __('Update the appearance settings for your account')">
        <flux:radio.group
            x-data
            variant="segmented"
            x-model="$flux.appearance"
            x-on:click="$nextTick(() => {
                const appearance = $flux.appearance;
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                if (appearance === 'system') {
                    window.localStorage.removeItem('flux.appearance');
                } else {
                    window.localStorage.setItem('flux.appearance', appearance);
                }

                document.documentElement.classList.toggle(
                    'dark',
                    appearance === 'dark' || (appearance === 'system' && prefersDark)
                );
            })"
        >
            <flux:radio value="light" icon="sun">{{ __('Light') }}</flux:radio>
            <flux:radio value="dark" icon="moon">{{ __('Dark') }}</flux:radio>
            <flux:radio value="system" icon="computer-desktop">{{ __('System') }}</flux:radio>
        </flux:radio.group>
    </x-settings.layout>
</section>
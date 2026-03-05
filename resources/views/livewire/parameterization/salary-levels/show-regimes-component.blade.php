<div x-data="{ tap: 1 }">
    <div class="flex items-center mb-4 gap-4">
        <flux:button variant="primary" class="rounded-full! flex-none! flex w-10! h-10!" href="{{ route('parametrization.regimes') }}">
            <flux:icon.arrow-left />
        </flux:button>

        <h1 class="text-2xl font-bold">
            Regimen - GEN_TERR
        </h1>
    </div>

    <div class="flex items-center overflow-x-auto mb-4 gap-4">
        <flux:button variant="primary" x-bind:class="tap === 1 ? 'bg-amber-500 dark:hover:bg-amber-500 text-white' : 'hover:bg-amber-500 hover:text-white'" @click="tap = 1">
            Niveles salariales
        </flux:button>

        <flux:button variant="primary" x-bind:class="tap === 2 ? 'bg-amber-500 dark:hover:bg-amber-500 text-white' : 'hover:bg-amber-500 hover:text-white'" @click="tap = 2">
            Decretos
        </flux:button>

        <flux:button variant="primary" x-bind:class="tap === 3 ? 'bg-amber-500 dark:hover:bg-amber-500 text-white' : 'hover:bg-amber-500 hover:text-white'" @click="tap = 3">
            Escalas salariales
        </flux:button>
    </div>

    <template x-if="tap === 1">
        @livewire('components.regime-levels.index-regime-level-component')
    </template>

    <template x-if="tap === 2">
        @livewire('components.salary-scale-decrees.index-salary-scale-decree-component')
    </template>

    <template x-if="tap === 3">
        @livewire('components.salary-scales.index-salary-scale-component')
    </template>
</div>

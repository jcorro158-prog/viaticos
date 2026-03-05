<div>
    <div class="flex items-center justify-between w-full gap-4 mb-4 flex-wrap">
        <div class="flex flex-col gap-1 grow">
            <flux:heading size="lg">
                Niveles
            </flux:heading>

            <flux:text>
                {{ __('Aquí puedes administrar los niveles de la institución, incluyendo la creación, edición y eliminación de niveles.') }}
            </flux:text>
        </div>
        
        {{-- Create Level --}}
        <flux:button variant="primary" x-on:click="$wire.dispatch('regime-level.create');">
            {{ __('Crear nivel') }}
        </flux:button>
    </div>

    {{-- Components --}}
    <livewire:components.regime-levels.create-regime-level-component :regimeId="$regimeId" />
    <livewire:components.regime-levels.edit-regime-level-component :regimeId="$regimeId" />
    <livewire:components.regime-levels.delete-regime-level-component :regimeId="$regimeId" />

    {{-- level List --}}
    <x-table :ths="['N°', 'Nombre', 'Código', 'Acciones']" classTh="nth-2:text-left!">
        <x-slot name="trs">
            @foreach ($regimeLevels as $regimeLevel)
                <tr class="text-center h-12 border-b border-zinc-800/10 dark:border-gray-200/20">
                    <td class="w-20 px-4 py-2">
                        {{ $loop->iteration }}
                    </td>

                    <td class="whitespace-nowrap px-4 py-2 text-left">
                        {{ $regimeLevel->name }}
                    </td>

                    <td class="px-4 py-2">
                        {{ $regimeLevel->code }}
                    </td>
                    
                    <td class="w-20 px-4 py-2">
                        <flux:dropdown position="left" align="center">
                            <button>
                                <flux:icon.ellipsis-vertical />
                            </button>

                            <flux:navmenu>
                                <flux:navmenu.item href="{{ route('parameterization.regimes.levels.grades.show') }}">
                                    <flux:icon.adjustments-horizontal />

                                    <div class="ml-2">
                                        {{ __('Grados') }}
                                    </div>
                                </flux:navmenu.item>

                                <flux:navmenu.item x-on:click="$wire.dispatch('regime-level.edit', { id: {{ $regimeLevel->id }} })">
                                    <flux:icon.pencil-square />

                                    <div class="ml-2">
                                        {{ __('Editar') }}
                                    </div>
                                </flux:navmenu.item>

                                <flux:navmenu.item class="text-red-500!" x-on:click="$wire.dispatch('regime-level.delete', { id: {{ $regimeLevel->id }} })">
                                    <flux:icon.trash />

                                    <div class="ml-2">
                                        {{ __('Eliminar') }}
                                    </div>
                                </flux:navmenu.item>
                            </flux:navmenu>
                        </flux:dropdown>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-table>
</div>

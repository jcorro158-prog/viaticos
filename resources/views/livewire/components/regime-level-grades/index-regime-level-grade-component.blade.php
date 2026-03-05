<div>
    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item href="{{Route('parametrization.regimes')}}" separator="slash">
            Regímenes
        </flux:breadcrumbs.item>

        <flux:breadcrumbs.item href="{{Route('parametrization.regimes.show', ['regimeId' => 1])}}" separator="slash">
            Regímen - GEN_TERR
        </flux:breadcrumbs.item>

        <flux:breadcrumbs.item href="{{Route('parametrization.regimes.show', ['regimeId' => 1])}}" separator="slash">
            Niveles
        </flux:breadcrumbs.item>

        <flux:breadcrumbs.item separator="slash">
            grados
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="flex items-center justify-between w-full gap-4 mb-4 flex-wrap">
        <div class="flex flex-col gap-1 grow">
            <flux:heading size="lg">
                Nivel - Directivos
            </flux:heading>

            <flux:text>
                {{ __('Aquí puedes administrar los grados de la institución, incluyendo la creación, edición y eliminación de grados.') }}
            </flux:text>
        </div>

        {{-- Create Grado --}}
        <flux:button variant="primary" x-on:click="$wire.dispatch('regime-level-grades.create');">
            {{ __('Crear asignación salarial') }}
        </flux:button>
    </div>

    {{-- Components --}}
    <livewire:components.regime-level-grades.create-regime-level-grade-component />
    <livewire:components.regime-level-grades.edit-regime-level-grade-component />
    <livewire:components.regime-level-grades.delete-regime-level-grade-component />

    {{-- Grados List --}}
    <x-table :ths="['N°', 'grados', 'salarios', 'Acciones']" classTh="nth-2:text-left!">
        <x-slot name="trs">
            <tr class="text-center h-12 border-b border-zinc-800/10 dark:border-gray-200/20">
                <td class="w-20 px-4 py-2">
                    1
                </td>

                <td class="whitespace-nowrap px-4 py-2 text-left">
                    Grado 1
                </td>

                <td class="px-4 py-2">
                    $1.0000.000
                </td>
                
                <td class="w-20 px-4 py-2">
                    <flux:dropdown position="left" align="center">
                        <button>
                            <flux:icon.ellipsis-vertical />
                        </button>

                        <flux:navmenu>
                            <flux:modal.trigger name="grade-modal">
                                <flux:navmenu.item>
                                    <flux:icon.pencil-square />

                                    <div class="ml-2">
                                        {{ __('Editar') }}
                                    </div>
                                </flux:navmenu.item>
                            </flux:modal.trigger>

                            <flux:modal.trigger name="confirm-grade-deletion-modal">
                                <flux:navmenu.item class="text-red-500!">
                                    <flux:icon.trash />

                                    <div class="ml-2">
                                        {{ __('Eliminar') }}
                                    </div>
                                </flux:navmenu.item>
                            </flux:modal.trigger>
                        </flux:navmenu>
                    </flux:dropdown>
                </td>
            </tr>
        </x-slot>
    </x-table>
</div>

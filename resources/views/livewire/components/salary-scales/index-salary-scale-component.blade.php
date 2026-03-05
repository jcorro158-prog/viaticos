<div>
    <div class="flex items-center justify-between w-full gap-4 mb-4 flex-wrap">
        <div class="flex flex-col gap-1 grow">
            <flux:heading size="lg">
                Escalas salariales
            </flux:heading>

            <flux:text>
                {{ __('Aquí puedes administrar las escalas salariales de la institución, incluyendo la creación, edición y eliminación de escalas.') }}
            </flux:text>
        </div>

        <flux:button variant="primary" x-on:click="$wire.dispatch('salary-scale.create');">
            {{ __('Crear asignacion salarial') }}
        </flux:button>
    </div>

    <div class="flex items-center gap-4 mb-4 flex-wrap">
        <flux:select placeholder="Seleccionar nivel" label="Filtro Nivel">
            <flux:select.option>Directivo</flux:select.option>
            <flux:select.option>Gerente</flux:select.option>
            <flux:select.option>Coordinador</flux:select.option>
            <flux:select.option>Asistente</flux:select.option>
        </flux:select>

        <flux:select placeholder="Seleccionar grado" label="Filtro Grado">
            <flux:select.option>Grado 1</flux:select.option>
            <flux:select.option>Grado 2</flux:select.option>
            <flux:select.option>Grado 3</flux:select.option>
            <flux:select.option>Grado 4</flux:select.option>
        </flux:select>

        <flux:select placeholder="Seleccionar año" label="Filtro Año">
            <flux:select.option>Año 2025</flux:select.option>
            <flux:select.option>Año 2024</flux:select.option>
            <flux:select.option>Año 2023</flux:select.option>
            <flux:select.option>Año 2022</flux:select.option>
        </flux:select>
    </div>

    {{-- salarios List --}}
    <x-table :ths="['N°', 'Nivel', 'Grado', 'Decreto', 'Año', 'Salario', 'Acciones']">
        <x-slot name="trs">
            <tr class="text-center h-12 border-b border-zinc-800/10 dark:border-gray-200/20">
                <td class="w-20 px-4 py-2">
                    1
                </td>

                <td class="whitespace-nowrap px-4 py-2">
                    Directivo
                </td>

                <td class="px-4 py-2">
                    Grado 1
                </td>

                <td class="whitespace-nowrap px-4 py-2">
                    Decreto 123 del 2023
                </td>

                <td class="whitespace-nowrap px-4 py-2">
                    23/12/2023
                </td>

                <td class="whitespace-nowrap px-4 py-2">
                    $ 6.000.0000
                </td>
                
                <td class="w-20 px-4 py-2">
                    <flux:dropdown position="left" align="center">
                        <button>
                            <flux:icon.ellipsis-vertical />
                        </button>

                        <flux:navmenu>
                            <flux:modal.trigger name="salary-scale-modal">
                                <flux:navmenu.item>
                                    <flux:icon.pencil-square />

                                    <div class="ml-2">
                                        {{ __('Editar') }}
                                    </div>
                                </flux:navmenu.item>
                            </flux:modal.trigger>

                            <flux:modal.trigger name="confirm-salary-scale-deletion-modal">
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

<div>
    <div class="flex items-center justify-between w-full gap-4 mb-4 flex-wrap">
        <div class="flex flex-col gap-1 grow">
            <flux:heading size="lg">
                Decretos
            </flux:heading>

            <flux:text>
                {{ __('Aquí puedes administrar los decretos de la institución, incluyendo la creación, edición y eliminación de decretos.') }}
            </flux:text>
        </div>

        {{-- Create Decree --}}
        <flux:button variant="primary" x-on:click="$wire.dispatch('salary-scale-decree.create');">
            {{ __('Crear decreto') }}
        </flux:button>
    </div>

    {{-- Components --}}
    <livewire:components.salary-scale-decrees.create-salary-scale-decree-component />
    <livewire:components.salary-scale-decrees.edit-salary-scale-decree-component />
    <livewire:components.salary-scale-decrees.delete-salary-scale-decree-component />

    {{-- Decree List --}}
    <x-table :ths="['N°', 'Decreto', 'Descripción', 'Fecha', 'Acciones']" classTh="nth-2:text-left!">
        <x-slot name="trs">
            @foreach ($salaryScaleDecrees as $salaryScaleDecree)
                <tr class="text-center h-12 border-b border-zinc-800/10 dark:border-gray-200/20">
                    <td class="w-20 px-4 py-2">
                        {{ $loop->iteration }}
                    </td>

                    <td class="whitespace-nowrap px-4 py-2 text-left">
                        {{ $salaryScaleDecree->decree }}
                    </td>

                    <td class="px-4 py-2">
                        <flux:tooltip content="{{ $salaryScaleDecree->description }}">
                            <div class="line-clamp-1">
                                {{ $salaryScaleDecree->description }}
                            </div>
                        </flux:tooltip>
                    </td>

                    <td class="whitespace-nowrap px-4 py-2">
                        {{ $salaryScaleDecree->date->format('d/m/Y') }}
                    </td>
                    
                    <td class="w-20 px-4 py-2">
                        <flux:dropdown position="left" align="center">
                            <button>
                                <flux:icon.ellipsis-vertical />
                            </button>

                            <flux:navmenu>
                                <flux:navmenu.item x-on:click="$wire.dispatch('salary-scale-decree.edit', { id: {{ $salaryScaleDecree->id }} })">
                                    <flux:icon.pencil-square />

                                    <div class="ml-2">
                                        {{ __('Editar') }}
                                    </div>
                                </flux:navmenu.item>

                                <flux:navmenu.item class="text-red-500!" x-on:click="$wire.dispatch('salary-scale-decree.delete', { id: {{ $salaryScaleDecree->id }} })">
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

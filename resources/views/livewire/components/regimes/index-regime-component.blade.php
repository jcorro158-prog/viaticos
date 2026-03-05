<div>
    <div class="flex items-center justify-between w-full gap-4 mb-4 flex-wrap">
        <div class="flex flex-col gap-1 grow">
            <flux:heading size="lg">
                {{ __('Regímenes') }}
            </flux:heading>

            <flux:text>
                {{ __('Aquí puedes administrar los regímenes de la institución, incluyendo la creación, edición y eliminación de regímenes.') }}
            </flux:text>
        </div>

        {{-- Create Regime --}}
        <flux:button variant="primary" x-on:click="$wire.dispatch('regime.create');">
            {{ __('Crear régimen') }}
        </flux:button>
    </div>

    {{-- Components --}}
    <livewire:components.regimes.create-regime-component />
    <livewire:components.regimes.edit-regime-component />
    <livewire:components.regimes.delete-regime-component />

    {{-- Regime List --}}
    <x-table :ths="['N°', 'Nombre', 'Descripción', 'Base Legal', 'Acciones']" classTh="nth-2:text-left!">
        <x-slot name="trs">
            @foreach ($regimes as $regime)
                <tr class="text-center h-12 border-b border-zinc-800/10 dark:border-gray-200/20">
                    <td class="w-20 px-4 py-2">
                        {{ $loop->iteration }}
                    </td>

                    <td class="whitespace-nowrap px-4 py-2 text-left">
                        {{ $regime->name }}
                    </td>

                    <td class="px-4 py-2">
                        @if (!$regime->description)
                            <span class="text-gray-500">{{ __('No disponible') }}</span>
                        @else
                            <flux:tooltip content="{{ $regime->description }}">
                                <div class="line-clamp-1">
                                    {{ $regime->description }}
                                </div>
                            </flux:tooltip>
                        @endif
                    </td>

                    <td class="px-4 py-2">
                        @if (!$regime->legal_basis)
                            <span class="text-gray-500">{{ __('No disponible') }}</span>
                        @else
                            <flux:tooltip content="{{ $regime->legal_basis }}">
                                <div class="line-clamp-1">
                                    {{ $regime->legal_basis }}
                                </div>
                            </flux:tooltip>
                        @endif
                    </td>

                    <td class="w-20 px-4 py-2">
                        <flux:dropdown position="left" align="center">
                            <button>
                                <flux:icon.ellipsis-vertical />
                            </button>

                            <flux:navmenu>
                                <flux:navmenu.item href="{{ route('parametrization.regimes.show', $regime->id) }}">
                                    <flux:icon.adjustments-horizontal />

                                    <div class="ml-2">
                                        {{ __('Administrar') }}
                                    </div>
                                </flux:navmenu.item>

                                <flux:navmenu.item x-on:click="$wire.dispatch('regime.edit', {id: {{ $regime->id }}})">
                                    <flux:icon.pencil-square />

                                    <div class="ml-2">
                                        {{ __('Editar') }}
                                    </div>
                                </flux:navmenu.item>

                                <flux:navmenu.item class="text-red-500!" x-on:click="$wire.dispatch('regime.delete', {id: {{ $regime->id }}})">
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

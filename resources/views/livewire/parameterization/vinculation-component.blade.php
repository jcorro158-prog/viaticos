<div>
    <div class="flex items-center justify-between w-full gap-4 mb-4 flex-wrap">
        <div class="flex flex-col gap-1 grow">
            <flux:heading size="lg">
                {{ __('Tipos de vinculación') }}
            </flux:heading>

            <flux:text>
                {{ __('Aquí puedes administrar los tipos de vinculación de la institución, incluyendo la creación, edición y eliminación de tipo de vinculación.') }}
            </flux:text>
        </div>

        <flux:modal.trigger name="vinculationModal">
            <flux:button variant="primary">
                {{ __('Crear tipo de vinculación') }}
            </flux:button>
        </flux:modal.trigger>
    </div>

    <x-table :ths="['N°', 'Nombre', 'ACCIONES']" classTh="nth-2:text-left!">
        <x-slot name="trs">
            <tr class="text-center h-12 border-b border-zinc-800/10 dark:border-gray-200/20">
                <td class="w-20 px-4 py-2">
                    1
                </td>

                <td class="whitespace-nowrap px-4 py-2 text-left">
                    Libre nombramiento
                </td>

                <td class="w-20 px-4 py-2">
                    <flux:dropdown position="left" align="center">
                        <button>
                            <flux:icon.ellipsis-vertical />
                        </button>

                        <flux:navmenu>
                            <flux:navmenu.item>
                                <flux:icon.pencil-square />

                                <div class="ml-2">
                                    {{ __('Editar') }}
                                </div>
                            </flux:navmenu.item>

                            <flux:modal.trigger name="confirm-vinculation-deletion">
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

    <flux:modal name="vinculationModal" class="w-full max-w-md">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">
                    {{ __('Crear nuevo tipo de vinculación') }}
                </flux:heading>

                <flux:text class="mt-2">
                    {{ __('Aquí puedes crear un nuevo tipo de vinculación para la institución. Asegúrate de proporcionar un nombre único y relevante para el tipo de vinculación.') }}
                </flux:text>
            </div>

            <flux:field>
                <flux:label>
                    {{ __('Nombre del tipo de vinculación') }}
                </flux:label>

                <flux:input />

                <flux:error name="username" />
            </flux:field>
        </div>
    </flux:modal>

    <flux:modal name="confirm-vinculation-deletion" class="max-w-lg">
        <div>
            <flux:heading size="lg">
                {{ __('Confirmar eliminación del tipo de vinculación') }}
            </flux:heading>

            <flux:subheading>
                {{ __('¿Estás seguro de que deseas eliminar este tipo de vinculación? Esta acción no se puede deshacer.') }}
            </flux:subheading>
        </div>

        <div class="flex justify-end space-x-2 rtl:space-x-reverse">
            <flux:modal.close>
                <flux:button variant="filled">{{ __('Cancel') }}</flux:button>
            </flux:modal.close>

            <flux:button variant="danger" type="submit">
                {{ __('Eliminar tipo de vinculación') }}
            </flux:button>
        </div>
    </flux:modal>
</div>

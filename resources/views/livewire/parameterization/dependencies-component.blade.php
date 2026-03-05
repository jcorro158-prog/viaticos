<div>
    <div class="flex items-center justify-between w-full gap-4 mb-4 flex-wrap">
        <div class="flex flex-col gap-1 grow">
            <flux:heading size="lg">
                {{ __('Dependencias') }}
            </flux:heading>

            <flux:text>
                {{ __('Aquí puedes administrar las dependencias de la institución, incluyendo la creación, edición y eliminación de puestos.') }}
            </flux:text>
        </div>

        <flux:modal.trigger name="new-dependency">
            <flux:button icon="plus" variant="primary">
                {{ __('Dependencia') }}
            </flux:button>
        </flux:modal.trigger>
    </div>

    <x-table :ths="['N°', 'Nombre', 'Estado', 'ACCIONES']" classTh="nth-2:text-left!">
        <x-slot name="trs">
            <tr class="text-center h-12 border-b border-zinc-800/10 dark:border-gray-200/20">
                <td class="w-20 px-4 py-2">
                    1
                </td>

                <td class="whitespace-nowrap px-4 py-2 text-left">
                    miguel rueda
                </td>

                <td class="whitespace-nowrap px-4 py-2 text-white!">
                    @if (true)
                        <flux:badge color="green" class="text-white!">
                            <flux:icon.check-badge class="inline-block mr-1" />
                            {{ __('Habilitado') }}
                        </flux:badge>
                    @else
                        <flux:badge color="red" class="text-white!">
                            <flux:icon.power class="inline-block mr-1" />
                            {{ __('Deshabilitado') }}
                        </flux:badge>
                    @endif
                </td>

                <td class="w-20 px-4 py-2">
                    <flux:dropdown position="left" align="center">
                        <button>
                            <flux:icon.ellipsis-vertical />
                        </button>

                        <flux:navmenu>
                            <flux:navmenu.item href="{{ route('users') }}">
                                <flux:icon.users />

                                <div class="ml-2">
                                    Funcionarios
                                </div>
                            </flux:navmenu.item>

                            <flux:modal.trigger name="history">
                                <flux:navmenu.item>
                                    <flux:icon.clock />
    
                                    <div class="ml-2">
                                        {{ __('Historial funcionarios') }}
                                    </div>
                                </flux:navmenu.item>
                            </flux:modal.trigger>

                            <flux:modal.trigger name="viewAudit">
                                <flux:navmenu.item>
                                    <flux:icon.shield-check />
    
                                    <div class="ml-2">
                                        {{ __('Auditoria') }}
                                    </div>
                                </flux:navmenu.item>
                            </flux:modal.trigger>

                            <flux:navmenu.item>
                                <flux:icon.check-badge />

                                <div class="ml-2">
                                    Habilitar
                                </div>
                            </flux:navmenu.item>

                            <flux:navmenu.item>
                                <flux:icon.pencil-square />

                                <div class="ml-2">
                                    {{ __('Editar') }}
                                </div>
                            </flux:navmenu.item>

                            <flux:modal.trigger name="confirm-dependency-deletion">
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

    <flux:modal name="new-dependency" class="w-full max-w-md">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">
                    {{ __('Crear nueva dependencia') }}
                </flux:heading>

                <flux:text class="mt-2">
                    {{ __('Completa el formulario a continuación para crear una nueva dependencia. Asegúrate de proporcionar un nombre único y descriptivo para la dependencia.') }}
                </flux:text>
            </div>

            <flux:field>
                <flux:label>
                    {{ __('Nombre de la dependencia') }}
                </flux:label>

                <flux:input />

                <flux:error name="username" />
            </flux:field>
        </div>
    </flux:modal>

    <flux:modal name="history" class="w-full max-w-6xl">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">
                    {{ __('Historial funcionarios') }}
                </flux:heading>

                <flux:text class="mt-2">
                    {{ __('Aquí puedes ver el historial de funcionarios asignados a esta dependencia. Puedes filtrar por fecha y buscar por nombre de funcionario.') }}
                </flux:text>
            </div>

            <x-table :ths="['Funcionario', 'Fecha inicio', 'Fecha fin', 'responsable']" classTh="nth-1:text-left! nth-4:text-left!">
                <x-slot name="trs">
                    <tr class="text-center h-12 border-b border-zinc-800/10 dark:border-gray-200/20">
                        <td class="whitespace-nowrap px-4 py-2 text-left">
                            Miguel Rueda
                        </td>

                        <td class="whitespace-nowrap px-4 py-2">
                            10/10/2023
                        </td>

                        <td class="whitespace-nowrap px-4 py-2">
                            10/10/2023
                        </td>

                        <td class="whitespace-nowrap px-4 py-2 text-left">
                            Miguel rueda
                        </td>
                    </tr>
                </x-slot>
            </x-table>
        </div>
    </flux:modal>

    <flux:modal name="viewAudit" class="w-full max-w-4xl">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">
                    {{ __('Auditoría') }}
                </flux:heading>

                <flux:text class="mt-2">
                    {{ __('A continuación se muestra el historial de auditoría de este puesto.') }}
                </flux:text>
            </div>

            <x-table :ths="['N°', 'Responsable', 'Fecha acción', 'accion']" classTh="nth-2:text-left! nth-4:text-left!">
                <x-slot name="trs">
                    <tr class="text-center h-12 border-b border-zinc-800/10 dark:border-gray-200/20">
                        <td class="w-20 px-4 py-2">
                            1
                        </td>

                        <td class="whitespace-nowrap px-4 py-2 text-left">
                            miguel rueda
                        </td>

                        <td class="whitespace-nowrap px-4 py-2">
                            10/10/2023
                        </td>

                        <td class="whitespace-nowrap px-4 py-2 text-left">
                            Creación de puesto
                        </td>
                    </tr>
                </x-slot>
            </x-table>
        </div>
    </flux:modal>

    <flux:modal name="confirm-dependency-deletion" class="max-w-lg">
        <div>
            <flux:heading size="lg">
                {{ __('Confirmar eliminación de dependencia') }}
            </flux:heading>

            <flux:subheading>
                {{ __('¿Estás seguro de que deseas eliminar esta dependencia? Esta acción no se puede deshacer.') }}
            </flux:subheading>
        </div>

        <div class="flex justify-end space-x-2 rtl:space-x-reverse">
            <flux:modal.close>
                <flux:button variant="filled">{{ __('Cancel') }}</flux:button>
            </flux:modal.close>

            <flux:button variant="danger" type="submit">
                {{ __('Eliminar Dependencia') }}
            </flux:button>
        </div>
    </flux:modal>
</div>

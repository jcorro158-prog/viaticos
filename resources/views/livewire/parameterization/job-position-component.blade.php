<div>
    <div class="flex items-center justify-between w-full gap-4 mb-4 flex-wrap">
        <div class="flex flex-col gap-1 grow">
            <flux:heading size="lg">
                {{ __('Puestos') }}
            </flux:heading>

            <flux:text>
                {{ __('A continuación se muestra la lista de puestos disponibles en el sistema.') }}
            </flux:text>
        </div>

        <flux:modal.trigger name="jobPosition">
            <flux:button variant="primary">
                {{ __('Nuevo puesto') }}
            </flux:button>
        </flux:modal.trigger>
    </div>

    <x-table :ths="['N°', 'Puesto', 'Salario', 'grado', 'dependencia', 'Ocupado', 'Estado', 'ACCIONES']" classTh="nth-2:text-left! nth-3:text-left! nth-4:text-left! nth-5:text-left! nth-6:text-left!">
        <x-slot name="trs">
            <tr class="text-center h-12 border-b border-zinc-800/10 dark:border-gray-200/20">
                <td class="w-20 px-4 py-2">
                    1
                </td>

                <td class="whitespace-nowrap px-4 py-2 text-left">
                    Administrador
                </td>

                <td class="whitespace-nowrap px-4 py-2 text-left">
                    $10.000.000
                </td>

                <td class="whitespace-nowrap px-4 py-2 text-left">
                    Libre nombramiento
                </td>

                <td class="whitespace-nowrap px-4 py-2 text-left">
                    Alcaldía Municipal
                </td>

                <td class="whitespace-nowrap px-4 py-2 text-left">
                    Miguel Rueda
                </td>

                <td class="whitespace-nowrap px-4 py-2">
                    Ocupado
                </td>

                <td class="w-20 px-4 py-2">
                    <flux:dropdown position="left" align="center">
                        <button>
                            <flux:icon.ellipsis-vertical />
                        </button>

                        <flux:navmenu>
                            <flux:modal.trigger name="official">
                                <flux:navmenu.item>
                                    <flux:icon.user-plus />

                                    <div class="ml-2">
                                        {{ __('Asignar') }}
                                    </div>
                                </flux:navmenu.item>
                            </flux:modal.trigger>

                            <flux:modal.trigger name="delegate">
                                <flux:navmenu.item>
                                    <flux:icon.user-plus />

                                    <div class="ml-2">
                                        {{ __('Encargado') }}
                                    </div>
                                </flux:navmenu.item>
                            </flux:modal.trigger>

                            <flux:modal.trigger name="release">
                                <flux:navmenu.item>
                                    <flux:icon.user-minus />

                                    <div class="ml-2">
                                        {{ __('Liberar') }}
                                    </div>
                                </flux:navmenu.item>
                            </flux:modal.trigger>

                            <flux:modal.trigger name="history">
                                <flux:navmenu.item>
                                    <flux:icon.clock />
    
                                    <div class="ml-2">
                                        {{ __('Historial Puestos') }}
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
                                <flux:icon.pencil-square />

                                <div class="ml-2">
                                    {{ __('Editar') }}
                                </div>
                            </flux:navmenu.item>

                            <flux:modal.trigger name="confirm-job-position-deletion">
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

    <flux:modal name="jobPosition" class="w-full max-w-md">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">
                    {{ __('Nuevo puesto') }}
                </flux:heading>

                <flux:text class="mt-2">
                    {{ __('Complete los campos a continuación para crear un nuevo puesto.') }}
                </flux:text>
            </div>

            <div class="grid grid-cols-1 gap-4">
                <flux:field>
                    <flux:label>
                        {{ __('Nombre puesto') }}
                    </flux:label>
    
                    <flux:input />
    
                    <flux:error name="username" />
                </flux:field>
            </div>

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary">
                    {{ __('Crear puesto') }}
                </flux:button>
            </div>
        </div>
    </flux:modal>
    
    <flux:modal name="official" class="w-full max-w-md">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">
                    {{ __('Asignar puesto') }}
                </flux:heading>

                <flux:text class="mt-2">
                    {{ __('Seleccione el funcionario que ocupará este puesto.') }}
                </flux:text>
            </div>

            <flux:field>
                <flux:label>Funcionario</flux:label>

                <flux:select placeholder="Choose industry...">
                    <flux:select.option>Photography</flux:select.option>
                    <flux:select.option>Design services</flux:select.option>
                    <flux:select.option>Web development</flux:select.option>
                    <flux:select.option>Accounting</flux:select.option>
                    <flux:select.option>Legal services</flux:select.option>
                    <flux:select.option>Consulting</flux:select.option>
                    <flux:select.option>Other</flux:select.option>
                </flux:select>

                <flux:error name="username" />
            </flux:field>

            <flux:field>
                <flux:label>Grado</flux:label>

                <flux:select placeholder="Choose industry...">
                    <flux:select.option>Photography</flux:select.option>
                    <flux:select.option>Design services</flux:select.option>
                    <flux:select.option>Web development</flux:select.option>
                    <flux:select.option>Accounting</flux:select.option>
                    <flux:select.option>Legal services</flux:select.option>
                    <flux:select.option>Consulting</flux:select.option>
                    <flux:select.option>Other</flux:select.option>
                </flux:select>

                <flux:error name="username" />
            </flux:field>

            <flux:field>
                <flux:label>Dependencia</flux:label>

                <flux:select placeholder="Choose industry...">
                    <flux:select.option>Photography</flux:select.option>
                    <flux:select.option>Design services</flux:select.option>
                    <flux:select.option>Web development</flux:select.option>
                    <flux:select.option>Accounting</flux:select.option>
                    <flux:select.option>Legal services</flux:select.option>
                    <flux:select.option>Consulting</flux:select.option>
                    <flux:select.option>Other</flux:select.option>
                </flux:select>

                <flux:error name="username" />
            </flux:field>

            <flux:field>
                <flux:label>Rol</flux:label>

                <flux:select placeholder="Choose industry...">
                    <flux:select.option>Photography</flux:select.option>
                    <flux:select.option>Design services</flux:select.option>
                    <flux:select.option>Web development</flux:select.option>
                    <flux:select.option>Accounting</flux:select.option>
                    <flux:select.option>Legal services</flux:select.option>
                    <flux:select.option>Consulting</flux:select.option>
                    <flux:select.option>Other</flux:select.option>
                </flux:select>

                <flux:error name="username" />
            </flux:field>

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary">
                    {{ __('Asignar') }}
                </flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="delegate" class="w-full max-w-md">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">
                    {{ __('Asignar funcionario encargado') }}
                </flux:heading>

                <flux:text class="mt-2">
                    {{ __('Seleccione el funcionario encargado de este puesto.') }}
                </flux:text>
            </div>

            <flux:field>
                <flux:label>Funcionario</flux:label>

                <flux:select placeholder="Choose industry...">
                    <flux:select.option>Photography</flux:select.option>
                    <flux:select.option>Design services</flux:select.option>
                    <flux:select.option>Web development</flux:select.option>
                    <flux:select.option>Accounting</flux:select.option>
                    <flux:select.option>Legal services</flux:select.option>
                    <flux:select.option>Consulting</flux:select.option>
                    <flux:select.option>Other</flux:select.option>
                </flux:select>

                <flux:error name="username" />
            </flux:field>

            <flux:field>
                <flux:label>Fecha inicio</flux:label>

                <flux:input type="date" />

                <flux:error name="username" />
            </flux:field>

            <flux:field>
                <flux:label>Fecha finalización</flux:label>

                <flux:input type="date" />

                <flux:error name="username" />
            </flux:field>

            <flux:field>
                <flux:label>Rol</flux:label>

                <flux:select placeholder="Choose industry...">
                    <flux:select.option>Photography</flux:select.option>
                    <flux:select.option>Design services</flux:select.option>
                    <flux:select.option>Web development</flux:select.option>
                    <flux:select.option>Accounting</flux:select.option>
                    <flux:select.option>Legal services</flux:select.option>
                    <flux:select.option>Consulting</flux:select.option>
                    <flux:select.option>Other</flux:select.option>
                </flux:select>

                <flux:error name="username" />
            </flux:field>

            <flux:field>
                <flux:label>Decreto</flux:label>

                <flux:input type="file" />

                <flux:error name="username" />
            </flux:field>

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary">
                    {{ __('Encargar') }}
                </flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="history" class="w-full max-w-6xl">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">
                    {{ __('Historial Puestos') }}
                </flux:heading>

                <flux:text class="mt-2">
                    {{ __('A continuación se muestra el historial de puestos ocupados por los funcionarios.') }}
                </flux:text>
            </div>

            <x-table :ths="['Funcionario', 'Puesto', 'grado', 'dependencia', 'Fecha inicio', 'Fecha fin', 'responsable', 'Estado', 'encargo']" classTh="nth-1:text-left! nth-7:text-left!">
                <x-slot name="trs">
                    <tr class="text-center h-12 border-b border-zinc-800/10 dark:border-gray-200/20">
                        <td class="whitespace-nowrap px-4 py-2 text-left">
                            Miguel Rueda
                        </td>

                        <td class="whitespace-nowrap px-4 py-2">
                            Alcalde
                        </td>

                        <td class="whitespace-nowrap px-4 py-2">
                            Ley
                        </td>

                        <td class="whitespace-nowrap px-4 py-2">
                            Alcaldía Municipal
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

                        <td class="whitespace-nowrap px-4 py-2">
                            Ocupado
                        </td>

                        <td class="whitespace-nowrap px-4 py-2">
                            N/A
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

    <flux:modal name="confirm-job-position-deletion" class="max-w-lg">
        <div>
            <flux:heading size="lg">
                {{ __('¿Estás seguro de que deseas eliminar este puesto?') }}
            </flux:heading>

            <flux:subheading>
                {{ __('Una vez que elimines este puesto, todos sus recursos y datos se eliminarán permanentemente. Por favor, confirma que deseas eliminar este puesto.') }}
            </flux:subheading>
        </div>

        <div class="flex justify-end space-x-2 rtl:space-x-reverse">
            <flux:modal.close>
                <flux:button variant="filled">{{ __('Cancel') }}</flux:button>
            </flux:modal.close>

            <flux:button variant="danger" type="submit">
                {{ __('Eliminar puesto') }}
            </flux:button>
        </div>
    </flux:modal>
    
    <flux:modal name="release" class="max-w-lg">
        <div class="mb-4">
            <flux:heading size="lg">
                {{ __('¿Estás seguro de que deseas liberar este puesto?') }}
            </flux:heading>

            <flux:subheading>
                {{ __('Una vez que liberes este puesto, todos los datos asociados se eliminarán permanentemente. Por favor, confirma que deseas liberar este puesto.') }}
            </flux:subheading>
        </div>

        <div class="flex justify-end space-x-2 rtl:space-x-reverse">
            <flux:modal.close>
                <flux:button variant="filled">{{ __('Cancel') }}</flux:button>
            </flux:modal.close>

            <flux:button variant="danger" type="submit">
                {{ __('Liberar puesto') }}
            </flux:button>
        </div>
    </flux:modal>
</div>

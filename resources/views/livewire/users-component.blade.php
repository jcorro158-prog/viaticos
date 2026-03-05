<div>
    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item href="{{Route('parametrization.dependencies')}}" separator="slash">
            Dependencias
        </flux:breadcrumbs.item>

        <flux:breadcrumbs.item separator="slash">
            Usuarios
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <h1 class="text-2xl font-bold mb-4">
        Usuarios de la Secretaría de Hacienda
    </h1>

    <div class="w-full flex justify-between items-end mb-4">
        <flux:select label="Registros" wire:model="industry" placeholder="Choose industry...">
            <flux:select.option>Photography</flux:select.option>
            <flux:select.option>Design services</flux:select.option>
            <flux:select.option>Web development</flux:select.option>
            <flux:select.option>Accounting</flux:select.option>
            <flux:select.option>Legal services</flux:select.option>
            <flux:select.option>Consulting</flux:select.option>
            <flux:select.option>Other</flux:select.option>
        </flux:select>

        <div class="flex items-center gap-2 flex-wrap">
            <div class="max-w-lg">
                <flux:input kbd="⌘K" icon="magnifying-glass" placeholder="Search..."/>
            </div>

             <flux:modal.trigger name="userModal">
                <flux:button icon="plus" variant="primary">
                    Asignar usuario
                </flux:button>
            </flux:modal.trigger>
        </div>
    </div>

    <x-table :ths="['N°', 'Nombre', 'rol', 'ACCIONES']" classTh="nth-2:text-left! nth-3:text-left!">
        <x-slot name="trs">
            <tr class="text-center h-12 border-b border-zinc-800/10 dark:border-gray-200/20">
                <td class="w-20 px-4 py-2">
                    1
                </td>

                <td class="whitespace-nowrap px-4 py-2 text-left">
                    miguel angel rueda palencia
                </td>

                <td class="whitespace-nowrap px-4 py-2 text-left">
                    Rol
                </td>

                <td class="w-20 px-4 py-2">
                    <flux:dropdown position="left" align="center">
                        <button>
                            <flux:icon.ellipsis-vertical />
                        </button>

                        <flux:navmenu>
                            <flux:modal.trigger name="viewData">
                                <flux:navmenu.item>
                                    <flux:icon.eye />

                                    <div class="ml-2">
                                        {{ __('Ver') }}
                                    </div>
                                </flux:navmenu.item>
                            </flux:modal.trigger>

                            <flux:modal.trigger name="viewData">
                                <flux:navmenu.item>
                                    <flux:icon.pencil-square />

                                    <div class="ml-2">
                                        {{ __('Editar') }}
                                    </div>
                                </flux:navmenu.item>
                            </flux:modal.trigger>

                            <flux:modal.trigger name="confirm-user-deletion">
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

    <flux:modal name="userModal" class="w-full max-w-xl">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">
                    {{ __('Asignar usuario') }}
                </flux:heading>

                <flux:text class="mt-2">
                    {{ __('Aquí puedes asignar un usuario a un rol específico.') }}
                </flux:text>
            </div>

            <div class="grid grid-cols-1 gap-4">
                <flux:select label="Usuario" placeholder="Seleccionar usuario...">
                    <flux:select.option>Photography</flux:select.option>
                </flux:select>

                <flux:select label="Rol" placeholder="Seleccionar rol...">
                    <flux:select.option>Photography</flux:select.option>
                </flux:select>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="viewData" class="w-full max-w-4xl">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">
                    {{ __('Información personal') }}
                </flux:heading>

                <flux:text class="mt-2">
                    {{ __('Aquí puedes ver la información personal del usuario seleccionado.') }}
                </flux:text>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <flux:field>
                    <flux:label>
                        {{ __('Nombres') }}
                    </flux:label>
    
                    <flux:input />
    
                    <flux:error name="username" />
                </flux:field>

                <flux:field>
                    <flux:label>
                        {{ __('Apellidos') }}
                    </flux:label>
    
                    <flux:input />
    
                    <flux:error name="username" />
                </flux:field>

                <flux:field>
                    <flux:label>
                        {{ __('Tipo de identificación') }}
                    </flux:label>
    
                    <flux:input />
    
                    <flux:error name="username" />
                </flux:field>

                <flux:field>
                    <flux:label>
                        {{ __('Identificación') }}
                    </flux:label>
    
                    <flux:input />
    
                    <flux:error name="username" />
                </flux:field>

                <flux:field>
                    <flux:label>
                        {{ __('Genero') }}
                    </flux:label>
    
                    <flux:input />
    
                    <flux:error name="username" />
                </flux:field>

                <flux:field>
                    <flux:label>
                        {{ __('Celular') }}
                    </flux:label>
    
                    <flux:input />
    
                    <flux:error name="username" />
                </flux:field>

                <flux:field class="sm:col-span-2">
                    <flux:label>
                        {{ __('Email') }}
                    </flux:label>
    
                    <flux:input />
    
                    <flux:error name="username" />
                </flux:field>

                <flux:field class="sm:col-span-2">
                    <flux:label>
                        {{ __('Dirección') }}
                    </flux:label>
    
                    <flux:input />
    
                    <flux:error name="username" />
                </flux:field>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="confirm-user-deletion" class="max-w-lg">
        <div class="mb-4">
            <flux:heading size="lg">
                {{ __('Confirmar eliminación del usuario de esta dependencia') }}
            </flux:heading>

            <flux:subheading>
                {{ __('¿Estás seguro de que deseas eliminar este usuario de la dependencia? Esta acción no se puede deshacer.') }}
            </flux:subheading>
        </div>

        <div class="flex justify-end">
            <flux:button variant="danger" type="submit">
                {{ __('Eliminar usuario de la dependencia') }}
            </flux:button>
        </div>
    </flux:modal>
</div>

<div x-data="{ progress: 50 }">
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

        <flux:modal.trigger name="new-commission">
            <flux:button variant="primary" icon="plus" class="flex items-center gap-2">
                Comisionado
            </flux:button>
        </flux:modal.trigger>
    </div>

    @for ($index = 0; $index < 3; $index++)
        <div class="bg-white/10 rounded-lg shadow-md mb-4">
            <div class="flex items-center flex-wrap justify-between border-b p-4 border-white">
                <div class="flex items-center gap-2">
                    <flux:badge size="lg" variant="solid" color="zinc">
                        Asignado
                    </flux:badge>

                    <span class="font-light">
                        <strong class="font-bold">
                            N° resolución:
                        </strong>
                        1472
                    </span>
                </div>

                <div class="flex items-center gap-2">
                    <div class="flex items-center gap-1">
                        <span class="font-bold text-lg text-orange-500">
                            Nombre:
                        </span>
            
                        <span class="font-light">
                            Miguel Angel Rueda Palencia
                        </span>
                    </div>
    
                    <flux:dropdown>
                        <flux:button variant="primary" icon:trailing="chevron-down">
                            Opciones
                        </flux:button>
    
                        <flux:menu>
                            <flux:modal.trigger name="view-commission">
                                <flux:menu.item>
                                    Aprobación talento humano a secretria x
                                </flux:menu.item>
                            </flux:modal.trigger>
    
                            <flux:menu.separator />

                            <flux:modal.trigger name="view-commission">
                                <flux:menu.item>
                                    Rechazar rechazo hacienda a talento humano
                                </flux:menu.item>
                            </flux:modal.trigger>
    
                            <flux:menu.separator />

                            <flux:modal.trigger name="view-commission">
                                <flux:menu.item>
                                    Aprobación hacienda a talento humano
                                </flux:menu.item>
                            </flux:modal.trigger>
    
                            <flux:menu.separator />

                            <flux:modal.trigger name="view-commission">
                                <flux:menu.item>
                                    Rechazar rechazo hacienda a talento humano
                                </flux:menu.item>
                            </flux:modal.trigger>
    
                            <flux:menu.separator />

                            <flux:modal.trigger name="view-commission">
                                <flux:menu.item>
                                    Aprobación talento humnao a hacienda
                                </flux:menu.item>
                            </flux:modal.trigger>
    
                            <flux:menu.separator />

                            <flux:modal.trigger name="view-commission">
                                <flux:menu.item>
                                    Rechazar talento humano a secretaria x
                                </flux:menu.item>
                            </flux:modal.trigger>
    
                            <flux:menu.separator />

                            <flux:modal.trigger name="view-commission">
                                <flux:menu.item>
                                    Aprobación secretria x
                                </flux:menu.item>
                            </flux:modal.trigger>
    
                            <flux:menu.separator />

                            <flux:modal.trigger name="view-commission">
                                <flux:menu.item>
                                    Rechazar secretaria x
                                </flux:menu.item>
                            </flux:modal.trigger>
    
                            <flux:menu.separator />

                            <flux:modal.trigger name="view-commission">
                                <flux:menu.item>
                                    Ver detalles
                                </flux:menu.item>
                            </flux:modal.trigger>
    
                            <flux:menu.separator />
                            
                            <flux:modal.trigger name="history">
                                <flux:menu.item>
                                    Auditoria
                                </flux:menu.item>
                            </flux:modal.trigger>
                        </flux:menu>
                    </flux:dropdown>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-0 pt-4 px-4">
                <div class="flex items-center gap-1">
                    <span class="font-bold text-lg text-orange-500">
                        Fecha de inicio:
                    </span>
        
                    <span class="font-light">
                        10/10/2023
                    </span>
                </div>

                <div class="flex items-center gap-1">
                    <span class="font-bold text-lg text-orange-500">
                        Fecha de finalización:
                    </span>

                    <span class="font-light">
                        20/10/2023
                    </span>
                </div>

                <div class="flex items-center gap-1">
                    <span class="font-bold text-lg text-orange-500">
                        Destino:
                    </span>

                    <span class="font-light">
                        Bogotá, Colombia
                    </span>
                </div>

                <div class="flex items-center gap-1">
                    <span class="font-bold text-lg text-orange-500">
                        Valor de la comisión:
                    </span>

                    <span class="font-light">
                        $500.000
                    </span>
                </div>

                <div class="flex items-center gap-1">
                    <span class="font-bold text-lg text-orange-500">
                        Dependencia:
                    </span>

                    <span class="font-light">
                        Gerencia de Proyectos
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 pb-4 px-4">
                <div class="flex items-center gap-1">
                    <span class="font-bold text-lg text-orange-500">
                        Descargar:
                    </span>
        
                    <flux:dropdown>
                        <button class="pt-2 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>

                        <flux:menu>
                            <flux:menu.item>Invitacion</flux:menu.item>

                            <flux:menu.separator />

                            <flux:menu.item>Evidencias</flux:menu.item>
                        </flux:menu>
                    </flux:dropdown>
                </div>
            </div>

            <div class="flex gap-2 items-center">
                <!-- Texto de porcentaje -->
                <div class="w-full h-1 relative bg-gray-600">
                    <!-- Fondo azul que avanza -->
                    <div
                        class="h-full bg-white transition-all duration-300"
                        :style="{ width: progress + '%' }"
                    ></div>
                </div>
            </div>
        </div>
    @endfor

    <flux:modal name="new-commission" class="w-full max-w-3xl">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">
                    {{ __('Nueva Comisión') }}
                </flux:heading>
                <flux:text class="mt-2">
                    {{ __('Complete los detalles de la nueva comisión para el comisionado.') }}
                </flux:text>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <flux:field class="sm:col-span-2">
                        <flux:label>
                            Objetivo de la Comisión
                        </flux:label>

                        <flux:textarea />
                </flux:field>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 col-span-1 sm:col-span-2">
                    <flux:field>
                        <flux:label>
                            Fecha de Inicio
                        </flux:label>
    
                        <flux:input type="date" />
                    </flux:field>
    
                    <flux:field>
                        <flux:label>
                            Fecha de Finalización
                        </flux:label>
    
                        <flux:input type="date" />
                    </flux:field>
    
                    <flux:field>
                        <flux:label>
                            Comisión en el exterior
                        </flux:label>
    
                        <flux:select wire:model="industry" placeholder="Choose industry...">
                            <flux:select.option selected>No</flux:select.option>
                            <flux:select.option>Si</flux:select.option>
                        </flux:select>
                    </flux:field>
                </div>

                <flux:field>
                    <flux:label>
                        Destino de la Comisión
                    </flux:label>

                    <flux:input />
                </flux:field>

                <flux:field>
                    <flux:label>
                        Gastos de capacitación
                    </flux:label>

                    <flux:select wire:model="industry" placeholder="Choose industry...">
                        <flux:select.option selected>No</flux:select.option>
                        <flux:select.option>Si</flux:select.option>
                    </flux:select>
                </flux:field>

                <flux:field>
                    <flux:label>
                        Valor de capacitación
                    </flux:label>

                    <flux:input icon="currency-dollar" x-mask:dynamic="$money($input, ',')" />
                </flux:field>

                <flux:field class="col-span-1 sm:col-span-2">
                    <flux:label>
                        Descripción
                    </flux:label>

                    <flux:textarea />
                </flux:field>

                <flux:field>
                    <flux:label>
                        Tipo de gastos
                    </flux:label>

                    <flux:select wire:model="industry" placeholder="Choose industry...">
                        <flux:select.option>Viáticos</flux:select.option>
                        <flux:select.option>Transporte</flux:select.option>
                        <flux:select.option>Alimentación</flux:select.option>
                        <flux:select.option>Hospedaje</flux:select.option>                          
                    </flux:select>
                </flux:field>

                <flux:field>
                    <flux:label>
                        Valor de gastos
                    </flux:label>

                    <flux:input icon="currency-dollar" x-mask:dynamic="$money($input, ',')" />
                </flux:field>

                <flux:field>
                    <flux:label>
                        Invitación
                    </flux:label>

                    <flux:input type="file" />
                </flux:field>
            </div>

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary">
                    {{ __('Crear Comisionado') }}
                </flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="view-commission" class="w-full max-w-3xl">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">
                    {{ __('Detalles de la Comisión') }}
                </flux:heading>
                <flux:text class="mt-2">
                    {{ __('Aquí puedes ver los detalles de la comisión asignada al comisionado.') }}
                </flux:text>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <flux:field class="sm:col-span-2">
                        <flux:label>
                            Objetivo de la Comisión
                        </flux:label>

                        <flux:textarea />
                </flux:field>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 col-span-1 sm:col-span-2">
                    <flux:field>
                        <flux:label>
                            Fecha de Inicio
                        </flux:label>
    
                        <flux:input type="date" />
                    </flux:field>
    
                    <flux:field>
                        <flux:label>
                            Fecha de Finalización
                        </flux:label>
    
                        <flux:input type="date" />
                    </flux:field>
    
                    <flux:field>
                        <flux:label>
                            Comisión en el exterior
                        </flux:label>
    
                        <flux:select wire:model="industry" placeholder="Choose industry...">
                            <flux:select.option selected>No</flux:select.option>
                            <flux:select.option>Si</flux:select.option>
                        </flux:select>
                    </flux:field>
                </div>

                <flux:field>
                    <flux:label>
                        Destino de la Comisión
                    </flux:label>

                    <flux:input />
                </flux:field>

                <flux:field>
                    <flux:label>
                        Gastos de capacitación
                    </flux:label>

                    <flux:select wire:model="industry" placeholder="Choose industry...">
                        <flux:select.option selected>No</flux:select.option>
                        <flux:select.option>Si</flux:select.option>
                    </flux:select>
                </flux:field>

                <flux:field>
                    <flux:label>
                        Valor de capacitación
                    </flux:label>

                    <flux:input icon="currency-dollar" x-mask:dynamic="$money($input, ',')" />
                </flux:field>

                <flux:field class="col-span-1 sm:col-span-2">
                    <flux:label>
                        Descripción
                    </flux:label>

                    <flux:textarea />
                </flux:field>

                <flux:field>
                    <flux:label>
                        Tipo de gastos
                    </flux:label>

                    <flux:select wire:model="industry" placeholder="Choose industry...">
                        <flux:select.option>Viáticos</flux:select.option>
                        <flux:select.option>Transporte</flux:select.option>
                        <flux:select.option>Alimentación</flux:select.option>
                        <flux:select.option>Hospedaje</flux:select.option>                          
                    </flux:select>
                </flux:field>

                <flux:field>
                    <flux:label>
                        Valor de gastos
                    </flux:label>

                    <flux:input icon="currency-dollar" x-mask:dynamic="$money($input, ',')" />
                </flux:field>
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
</div>
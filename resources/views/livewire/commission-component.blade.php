<div x-data="{ progress: 50 }">
    {{-- MENSAJES DE NOTIFICACIÓN --}}
    @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" 
             x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90" 
             x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300" 
             x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" 
             class="mb-4 p-4 bg-green-500/20 border border-green-500 text-green-200 rounded-lg flex justify-between items-center shadow-lg">
            <div class="flex items-center gap-2">
                <flux:icon.check-circle variant="solid" class="text-green-500" />
                <span>{{ session('message') }}</span>
            </div>
            <button @click="show = false" class="text-green-500 hover:text-green-300 font-bold text-xl line-none">&times;</button>
        </div>
    @endif

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
            <flux:button variant="primary" icon="plus" class="flex items-center gap-2" wire:click="resetFields">
                Comisionado
            </flux:button>
        </flux:modal.trigger>
    </div>

    {{-- LISTADO DINÁMICO DE COMISIONES --}}
    @foreach ($commissions as $commission)
        <div class="bg-white/10 rounded-lg shadow-md mb-4 border border-white/5 hover:border-white/20 transition-all">
            <div class="flex items-center flex-wrap justify-between border-b p-4 border-white">
                <div class="flex items-center gap-2">
                    <span class="flex items-center justify-center bg-orange-600 text-white font-bold h-8 w-8 rounded-lg shadow-sm mr-2 text-sm">
                        {{ $loop->iteration }}
                    </span>

                    <flux:badge size="lg" variant="solid" color="zinc">
                        {{ $commission->commissionStatus->name ?? 'Asignado' }}
                    </flux:badge>

                    <span class="font-light">
                        <strong class="font-bold">N° resolución:</strong>
                        {{ $commission->resolutions->first()->number ?? '1472' }}
                    </span>
                </div>

                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-1 bg-black/20 rounded-lg p-1">
                        <flux:button variant="ghost" size="sm" icon="pencil" wire:click="edit({{ $commission->id }})" class="text-blue-400 hover:text-blue-300" />
                        <flux:button variant="ghost" size="sm" icon="trash" wire:click="delete({{ $commission->id }})" wire:confirm="¿Estás seguro de que deseas eliminar este comisionado?" class="text-red-400 hover:text-red-300" />
                    </div>

                    <div class="flex items-center gap-1">
                        <span class="font-bold text-lg text-orange-500">Nombre:</span>
                        <span class="font-light">{{ $commission->user->name ?? 'Miguel Angel Rueda Palencia' }}</span>
                    </div>
    
                    <flux:dropdown>
                        <flux:button variant="primary" icon:trailing="chevron-down">Opciones</flux:button>
                        <flux:menu>
                            <flux:modal.trigger name="view-commission"><flux:menu.item>Aprobación talento humano a secretria x</flux:menu.item></flux:modal.trigger>
                            <flux:menu.separator />
                            <flux:modal.trigger name="view-commission"><flux:menu.item>Rechazar rechazo hacienda a talento humano</flux:menu.item></flux:modal.trigger>
                            <flux:menu.separator />
                            <flux:modal.trigger name="view-commission"><flux:menu.item>Aprobación hacienda a talento humano</flux:menu.item></flux:modal.trigger>
                            <flux:menu.separator />
                            <flux:modal.trigger name="view-commission"><flux:menu.item>Rechazar rechazo hacienda a talento humano</flux:menu.item></flux:modal.trigger>
                            <flux:menu.separator />
                            <flux:modal.trigger name="view-commission"><flux:menu.item>Aprobación talento humnao a hacienda</flux:menu.item></flux:modal.trigger>
                            <flux:menu.separator />
                            <flux:modal.trigger name="view-commission"><flux:menu.item>Rechazar talento humano a secretaria x</flux:menu.item></flux:modal.trigger>
                            <flux:menu.separator />
                            <flux:modal.trigger name="view-commission"><flux:menu.item>Aprobación secretria x</flux:menu.item></flux:modal.trigger>
                            <flux:menu.separator />
                            <flux:modal.trigger name="view-commission"><flux:menu.item>Rechazar secretaria x</flux:menu.item></flux:modal.trigger>
                            <flux:menu.separator />
                            <flux:modal.trigger name="view-commission"><flux:menu.item>Ver detalles</flux:menu.item></flux:modal.trigger>
                            <flux:menu.separator />
                            <flux:modal.trigger name="history"><flux:menu.item>Auditoria</flux:menu.item></flux:modal.trigger>
                        </flux:menu>
                    </flux:dropdown>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-0 pt-4 px-4">
                <div class="flex items-center gap-1">
                    <span class="font-bold text-lg text-orange-500">Fecha de inicio:</span>
                    <span class="font-light">{{ $commission->start_date->format('d/m/Y') }}</span>
                </div>
                <div class="flex items-center gap-1">
                    <span class="font-bold text-lg text-orange-500">Fecha de finalización:</span>
                    <span class="font-light">{{ $commission->end_date->format('d/m/Y') }}</span>
                </div>
                <div class="flex items-center gap-1">
                   <span class="font-bold text-lg text-orange-500">Cédula:</span>
                   <span class="font-light">{{ $commission->identification ?? 'Sin asignar' }}</span>
                </div>
                <div class="flex items-center gap-1">
                    <span class="font-bold text-lg text-orange-500">Gastos de capacitación:</span>
                    <span class="font-light">
                        @if($commission->training_value && $commission->training_value > 0)
                            ${{ number_format($commission->training_value, 0, ',', '.') }}
                        @else
                            No aplica
                        @endif
                    </span>
                </div>
                <div class="flex items-center gap-1">
                    <span class="font-bold text-lg text-orange-500">Objetivo:</span>
                    <span class="font-light">{{ $commission->objetive }}</span>
                </div>
                <div class="flex items-center gap-1">
                    <span class="font-bold text-lg text-orange-500">Destino:</span>
                    <span class="font-light">{{ $commission->destination }}</span>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 pb-4 px-4">
                <div class="flex items-center gap-1">
                    <span class="font-bold text-lg text-orange-500">Descargar:</span>
                    <flux:dropdown>
                        <button class="pt-2 cursor-pointer outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>
                        <flux:menu>
                            @if(!empty($commission->invitation_path))
                                <flux:menu.item href="{{ asset('storage/' . $commission->invitation_path) }}" target="_blank">Ver Invitacion</flux:menu.item>
                            @else
                                <flux:menu.item disabled class="opacity-50">Invitacion (No disponible)</flux:menu.item>
                            @endif
                            <flux:menu.separator />
                            @if(!empty($commission->evidence_path))
                                <flux:menu.item href="{{ asset('storage/' . $commission->evidence_path) }}" target="_blank">Ver Evidencias</flux:menu.item>
                            @else
                                <flux:modal.trigger name="upload-evidence-{{ $commission->id }}">
                                    <flux:menu.item>Subir Evidencias</flux:menu.item>
                                </flux:modal.trigger>
                            @endif
                        </flux:menu>
                    </flux:dropdown>
                </div>
            </div>

            <flux:modal name="upload-evidence-{{ $commission->id }}" class="max-w-md" wire:ignore.self>
                <form wire:submit.prevent="uploadEvidence({{ $commission->id }})" enctype="multipart/form-data" class="space-y-4">
                    <flux:heading>Subir Evidencias</flux:heading>
                    <flux:field>
                        <flux:label>Seleccione el archivo de evidencia</flux:label>
                        <flux:input type="file" wire:model="evidence_file" wire:key="evid-{{ $commission->id }}" />
                    </flux:field>
                    <div class="flex justify-end">
                        <flux:button type="submit" variant="primary">Subir</flux:button>
                    </div>
                </form>
            </flux:modal>

            <div class="flex gap-2 items-center p-4">
                <div class="w-full h-1 relative bg-gray-600">
                    <div class="h-full bg-white transition-all duration-300" :style="{ width: progress + '%' }"></div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- MODAL GESTIÓN COMISIÓN --}}
    <flux:modal name="new-commission" class="w-full max-w-3xl" wire:ignore.self>
        <form wire:submit="save" enctype="multipart/form-data" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $commission_id ? __('Editar Comisión') : __('Nueva Comisión') }}</flux:heading>
                <flux:text class="mt-2">{{ __('Complete los detalles para gestionar la comisión del funcionario.') }}</flux:text>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <flux:field class="sm:col-span-2">
                    <flux:label>Objetivo de la Comisión</flux:label>
                    <flux:textarea wire:model="objective" />
                </flux:field>

                <flux:field class="sm:col-span-2">
                    <flux:label>Cédula / Identificación</flux:label>
                    <flux:input wire:model="identification" inputmode="numeric" maxlength="12" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 12)" />
                </flux:field>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 col-span-1 sm:col-span-2">
                    <flux:field>
                        <flux:label>Fecha de Inicio</flux:label>
                        <flux:input type="date" wire:model="start_date" />
                    </flux:field>
                    <flux:field>
                        <flux:label>Fecha de Finalización</flux:label>
                        <flux:input type="date" wire:model="end_date" />
                    </flux:field>
                    <flux:field>
                        <flux:label>¿Comisión en el exterior?</flux:label>
                        <flux:select wire:model.live="is_exterior">
                            <flux:select.option value="0">No</flux:select.option>
                            <flux:select.option value="1">Si</flux:select.option>
                        </flux:select>
                    </flux:field>
                </div>

                {{-- DESPLIEGUE EXTERIOR --}}
                @if(($is_exterior ?? '0') == '1')
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 col-span-1 sm:col-span-2 p-4 bg-zinc-800/50 rounded-lg border border-orange-500/30">
                        <flux:field>
                            <flux:label>Zona a la que se dirige</flux:label>
                            <flux:select wire:model="exterior_zone">
                                <flux:select.option value="">- Seleccione -</flux:select.option>
                                <flux:select.option value="centro_sur_america">Centro América, El Caribe y Suramérica exepto Brasil, Chile, Argentina y Puerto Rico</flux:select.option>
                                <flux:select.option value="norte_america_otros">Estados Unidos, Canadá, Chile, Brasil, África y Puerto Rico</flux:select.option>
                                <flux:select.option value="europa_asia">Europa, Asia, Oseanía, Mexico y Argentina</flux:select.option>
                            </flux:select>
                        </flux:field>
                        <flux:field>
                            <flux:label>Valor del dólar (TRM)</flux:label>
                            <flux:input icon="currency-dollar" wire:model="dollar_value" />
                        </flux:field>
                    </div>
                @endif

                <flux:field>
                    <flux:label>Destino de la Comisión</flux:label>
                    <flux:input wire:model="destination" />
                </flux:field>

                <flux:field>
                    <flux:label>Gastos de capacitación</flux:label>
                    <flux:select wire:model.live="training_gastos_toggle">
                        <flux:select.option value="0">No</flux:select.option>
                        <flux:select.option value="1">Si</flux:select.option>
                    </flux:select>
                </flux:field>

                {{-- DESPLIEGUE CAPACITACIÓN --}}
                @if(($training_gastos_toggle ?? '0') == '1')
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 col-span-1 sm:col-span-2 p-4 bg-blue-900/20 rounded-lg border border-blue-500/30">
                        <flux:field>
                            <flux:label>Detalles de capacitación</flux:label>
                            <flux:textarea wire:model="training_details" placeholder="¿Qué capacitación es?" />
                        </flux:field>
                        <flux:field>
                            <flux:label>Valor de capacitación</flux:label>
                            <flux:input icon="currency-dollar" x-mask:dynamic="$money($input, ',')" wire:model="training_value" placeholder="0,00" />
                        </flux:field>
                    </div>
                @endif

                <flux:field class="col-span-1 sm:col-span-2">
                    <flux:label>Descripción adicional</flux:label>
                    <flux:textarea wire:model="description" />
                </flux:field>

                <flux:field>
                    <flux:label>Tipo de gastos</flux:label>
                    <flux:select wire:model="expense_type">
                        <flux:select.option>Viáticos</flux:select.option>
                        <flux:select.option>Transporte</flux:select.option>
                        <flux:select.option>Alimentación</flux:select.option>
                        <flux:select.option>Hospedaje</flux:select.option>                                            
                    </flux:select>
                </flux:field>

                <flux:field>
                    <flux:label>Valor de gastos</flux:label>
                    <flux:input icon="currency-dollar" x-mask:dynamic="$money($input, ',')" wire:model="expense_value" />
                </flux:field>

                <flux:field>
                    <flux:label>Invitación</flux:label>
                    <flux:input type="file" wire:model="invitation_file" wire:key="inv-{{ $commission_id ?? 'new' }}" />
                </flux:field>
            </div>

            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary">
                    {{ $commission_id ? __('Guardar Cambios') : __('Crear Comisionado') }}
                </flux:button>
            </div>
        </form>
    </flux:modal>

    <flux:modal name="view-commission" class="w-full max-w-3xl">
        <flux:heading size="lg">Detalles</flux:heading>
    </flux:modal>

    <flux:modal name="history" class="w-full max-w-6xl">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Historial Puestos') }}</flux:heading>
                <flux:text class="mt-2">{{ __('Historial de puestos ocupados por los funcionarios.') }}</flux:text>
            </div>
            <x-table :ths="['Funcionario', 'Puesto', 'grado', 'dependencia', 'Fecha inicio', 'Fecha fin', 'responsable', 'Estado', 'encargo']">
                <x-slot name="trs">
                    <tr class="text-center h-12 border-b border-zinc-800/10 dark:border-gray-200/20">
                        <td class="px-4 py-2 text-left">Miguel Rueda</td>
                        <td class="px-4 py-2">Alcalde</td>
                        <td class="px-4 py-2">Ley</td>
                        <td class="px-4 py-2">Alcaldía Municipal</td>
                        <td class="px-4 py-2">10/10/2023</td>
                        <td class="px-4 py-2">10/10/2023</td>
                        <td class="px-4 py-2">Miguel rueda</td>
                        <td class="px-4 py-2">Ocupado</td>
                        <td class="px-4 py-2">N/A</td>
                    </tr>
                </x-slot>
            </x-table>
        </div>
    </flux:modal>
</div>
<div>
    <flux:modal name="create-regime-level-grade-modal" class="w-full max-w-2xl">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Crear nuevo grado</flux:heading>
                <flux:text class="mt-2">Complete los detalles a continuación.</flux:text>
            </div>

            <flux:select wire:model="period" label="Periodo" placeholder="Seleccionar periodo..." x-data="{ years: Array.from({ length: 2 }, (_, i) => new Date().getFullYear() - i) }">
                <template x-for="year in years" :key="year">
                    <flux:select.option x-text="year"></flux:select.option>
                </template>
            </flux:select>

            <flux:select wire:model="name" label="Nivel - grado" placeholder="Seleccionar nivel - grado...">
                <flux:select.option>
                    Directivo - Grado 1
                </flux:select.option>
            </flux:select>

            <flux:select wire:model="decree" label="Decreto" placeholder="Seleccionar decreto...">
                <flux:select.option>
                    Decreto 123 del 2023
                </flux:select.option>
            </flux:select>

            <flux:select label="Tipo" placeholder="Seleccionar tipo...">
                <flux:select.option>
                    Asignación
                </flux:select.option>

                <flux:select.option>
                    Aumento
                </flux:select.option>
            </flux:select>

            <flux:input icon="currency-dollar" wire:model="salary" label="Valor salarial del periodo" x-mask:dynamic="$money($input, ',')" />

            <flux:input icon="chevron-double-up" wire:model="increase_percentage" label="Porcentaje de aumento" type="number" placeholder="ejemplo: 10" />

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" wire:click="store" variant="primary">Crear</flux:button>
            </div>
        </div>
    </flux:modal>
</div>

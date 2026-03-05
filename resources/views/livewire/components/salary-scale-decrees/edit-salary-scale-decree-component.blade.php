<div>
    <flux:modal name="edit-salary-scale-decree-modal" class="w-full max-w-2xl">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Editar decreto</flux:heading>
                <flux:text class="mt-2">Complete los detalles a continuación.</flux:text>
            </div>

            <flux:input label="Nombre del decreto" wire:model="decree" />

            <flux:textarea label="Descripción del decreto" wire:model="description" />

            <flux:input label="Fecha de inicio" type="date" wire:model="date" />

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" wire:click="update" variant="primary">Guardar</flux:button>
            </div>
        </div>
    </flux:modal>
</div>

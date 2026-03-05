<div>
    <flux:modal name="create-regime-modal" class="w-full max-w-2xl">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Crear nuevo régimen</flux:heading>
                <flux:text class="mt-2">Complete los detalles a continuación.</flux:text>
            </div>

            <flux:input label="Nombre del regimen" wire:model="name" />

            <flux:textarea label="Descripción" wire:model="description" />

            <flux:input label="Base Legal" wire:model="legalBasis" />

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" wire:click="store" variant="primary">Crear</flux:button>
            </div>
        </div>
    </flux:modal>
</div>

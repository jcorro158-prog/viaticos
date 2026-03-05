<div>
    <flux:modal name="create-regime-level-modal" class="w-full max-w-2xl">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Crear nuevo nivel</flux:heading>
                <flux:text class="mt-2">Complete los detalles a continuación.</flux:text>
            </div>

            <flux:input label="Nombre del nivel"  wire:model="name" />

            <flux:input label="Código del nivel" wire:model="code"/>

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" wire:click="store" variant="primary">Crear</flux:button>
            </div>
        </div>
    </flux:modal>
</div>

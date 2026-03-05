<div>
    <flux:modal name="delete-regime-level-modal" class="w-full max-w-md">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Eliminar nivel</flux:heading>
                <flux:text class="mt-2">¿Está seguro de que desea eliminar este nivel?</flux:text>
            </div>

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" wire:click="destroy" variant="danger">Eliminar</flux:button>
            </div>
        </div>
    </flux:modal>
</div>

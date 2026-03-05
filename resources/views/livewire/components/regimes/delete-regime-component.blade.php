<div>
    <flux:modal name="delete-regime-modal" class="w-full max-w-md">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Eliminar régimen</flux:heading>
                <flux:text class="mt-2">¿Está seguro de que desea eliminar este régimen?</flux:text>
            </div>

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="danger" wire:click="destroy">Eliminar</flux:button>
            </div>
        </div>
    </flux:modal>
</div>

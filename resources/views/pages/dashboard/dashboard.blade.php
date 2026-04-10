<div class="p-2 space-y-4">
    <div class="grid grid-cols-2 gap-4">
        <flux:card size="sm">
            <flux:heading class="flex items-center gap-2">{{ __('Recipes') }}</flux:heading>
            <flux:text class="mt-2">{{ $this->stats['recipes'] }}</flux:text>
        </flux:card>
        <flux:card size="sm">
            <flux:heading class="flex items-center gap-2">{{ __('Inventory') }}</flux:heading>
            <flux:text class="mt-2">{{ $this->stats['items'] }}</flux:text>
        </flux:card>
    </div>

    <flux:button wire:click="sync">{{ __('Sync from Data') }}</flux:button>
</div>

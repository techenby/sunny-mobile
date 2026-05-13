<div>
    <x-top-bar :title="__('Add Item')" :with-back="route('inventory.index')" />

    <main class="p-4">
        <form wire:submit="save" class="space-y-6">
            <flux:input wire:model="name" :label="__('Name')" type="text" required />

            <flux:select wire:model="type" :label="__('Type')" placeholder="Select type" variant="listbox" searchable>
                @foreach (\App\Enums\ItemType::cases() as $type)
                    <flux:select.option :value="$type->value">{{ ucfirst($type->value) }}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:select wire:model="parent_id" :label="__('Parent')" variant="listbox" searchable>
                <flux:select.option value="">{{ __('None') }}</flux:select.option>
                @foreach ($this->parentItems as $parentItem)
                    <flux:select.option :value="$parentItem->id">{{ $parentItem->name }}</flux:select.option>
                @endforeach
            </flux:select>

            <div>
                <flux:label class="mb-2">{{ __('Metadata') }}</flux:label>

                <div class="space-y-2">
                    @foreach ($metadata as $index => $pair)
                        <div class="flex items-start gap-2">
                            <flux:input wire:model="metadata.{{ $index }}.key" placeholder="{{ __('Key') }}" size="sm" />
                            <flux:input wire:model="metadata.{{ $index }}.value" placeholder="{{ __('Value') }}" size="sm" />
                            <flux:button variant="ghost" size="sm" icon="x-mark" wire:click="removeMetadata({{ $index }})" />
                        </div>
                    @endforeach
                </div>

                <flux:button variant="ghost" size="sm" icon="plus" wire:click="addMetadata" class="mt-2">{{ __('Add field') }}</flux:button>
            </div>

            <div class="flex gap-2">
                <flux:button :href="route('inventory.index')" variant="ghost" class="flex-1">{{ __('Cancel') }}</flux:button>
                <flux:button type="submit" variant="primary" class="flex-1">{{ __('Create') }}</flux:button>
            </div>
        </form>
    </main>
</div>

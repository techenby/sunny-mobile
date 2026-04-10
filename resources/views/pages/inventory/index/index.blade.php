<div class="p-2 space-y-6">
    <flux:heading level="1" size="xl">{{ __('Inventory') }}</flux:heading>

    <flux:input wire:model.live="search" placeholder="Search" />

    <div class="divide-y divide-zinc-200 dark:divide-zinc-700">
        @foreach ($this->items as $item)
        <a href="{{ route('inventory.show', $item) }}" class="py-2 flex space-x-4">
            <flux:avatar size="xl" :icon="$item->type->getIcon()" :color="$item->type->getIconColor()" icon:variant="outline" />
            <div class="space-y-1">
                <flux:heading>{{ $item->truncated_name }}</flux:heading>
                <dl class="flex gap-2">
                    @if ($item->parent)
                    <div class="flex gap-2 items-center">
                        <dt><flux:icon.arrow-up variant="micro" /></dt>
                        <dd class="text-sm">{{ $item->parent->name }}</dd>
                    </div>
                    @endif
                </dl>
                <flux:text>{{ $item->metadata_list }}</flux:text>
            </div>
        </a>
        @endforeach
    </div>
</div>

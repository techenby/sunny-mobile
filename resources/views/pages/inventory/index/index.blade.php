<div class="p-4 space-y-4">
    <flux:input wire:model.live="search" placeholder="Search inventory..." icon="magnifying-glass" />

    @foreach ($this->items->groupBy(fn ($item) => $item->type->value) as $type => $items)
    <div class="space-y-1">
        <div class="px-1 text-xs text-zinc-500 dark:text-zinc-400">{{ Str::ucfirst(Str::plural($type)) }}</div>
        <div class="divide-y divide-zinc-950/5 dark:divide-white/10 rounded-xl border border-zinc-950/5 dark:border-white/10">
            @foreach ($items as $item)
            <a href="{{ route('inventory.show', $item) }}" class="flex items-center gap-3 px-3 py-3 min-h-11 active:bg-zinc-950/5 dark:active:bg-white/5">
                <flux:icon :name="$item->type->getIcon()" variant="mini" class="size-5 shrink-0 text-{{ $item->type->getIconColor() }}-500" />
                <div class="min-w-0 flex-1">
                    <flux:heading class="truncate text-sm">{{ $item->truncated_name }}</flux:heading>
                    @if ($item->parent)
                    <flux:text class="text-xs">{{ $item->parent->name }}</flux:text>
                    @endif
                </div>
                <flux:icon.chevron-right variant="micro" class="size-3.5 text-zinc-400 shrink-0" />
            </a>
            @endforeach
        </div>
    </div>
    @endforeach
</div>

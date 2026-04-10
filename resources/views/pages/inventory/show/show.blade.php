<div class="space-y-6 p-2">
    <flux:breadcrumbs>
        <flux:breadcrumbs.item :href="route('inventory.index')" class="cursor-pointer">
            {{ __('Inventory') }}
        </flux:breadcrumbs.item>

        @foreach ($this->breadcrumbs as $breadcrumb)
            <flux:breadcrumbs.item :href="route('inventory.index', ['parentId' => $breadcrumb->id])" class="cursor-pointer">
                {{ $breadcrumb->name }}
            </flux:breadcrumbs.item>
        @endforeach

        <flux:breadcrumbs.item>
            {{ $item->name }}
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="flex items-center gap-4">
        <flux:button :href="route('inventory.index', ['parentId' => $item->parent_id])" icon="arrow-left" />
        <flux:heading size="xl" class="flex items-center gap-3">
            <flux:avatar size="sm" :icon="$item->type->getIcon()" :color="$item->type->getIconColor()" icon:variant="outline" />
            {{ $item->name }}
        </flux:heading>
    </div>

    @if ($item->photo_path)
        <img src="{{ Storage::temporaryUrl($item->photo_path, now()->addMinutes(30)) }}" alt="{{ $item->name }}" class="w-full rounded-lg object-cover max-h-96" />
    @endif

    <div class="divide-y divide-zinc-950/5 dark:divide-white/10 rounded-xl border border-zinc-950/5 dark:border-white/10">
        <div class="flex items-center justify-between px-3 py-3">
            <span class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('Type') }}</span>
            <span class="flex items-center gap-2 text-sm font-medium">
                <flux:icon :name="$item->type->getIcon()" variant="mini" class="size-4 text-{{ $item->type->getIconColor() }}-500" />
                {{ ucfirst($item->type->value) }}
            </span>
        </div>

        @if ($item->parent)
            <div class="flex items-center justify-between px-3 py-3">
                <span class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('Location') }}</span>
                <flux:link href="{{ route('inventory.show', $item->parent) }}" wire:navigate class="text-sm">
                    {{ $item->parent->name }}
                </flux:link>
            </div>
        @endif

        <div class="flex items-center justify-between px-3 py-3">
            <span class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('Added') }}</span>
            <span class="text-sm tabular-nums">{{ $item->created_at->format('M j, Y') }}</span>
        </div>

        @if ($item->updated_at->gt($item->created_at))
            <div class="flex items-center justify-between px-3 py-3">
                <span class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('Updated') }}</span>
                <span class="text-sm tabular-nums">{{ $item->updated_at->format('M j, Y') }}</span>
            </div>
        @endif
    </div>

    @if ($item->metadata !== null)
        <div class="space-y-1">
            <div class="px-1 text-xs text-zinc-500 dark:text-zinc-400">{{ __('Metadata') }}</div>
            <div class="divide-y divide-zinc-950/5 dark:divide-white/10 rounded-xl border border-zinc-950/5 dark:border-white/10">
                @foreach ($item->metadata as $key => $value)
                    <div class="flex items-center justify-between px-3 py-3">
                        <span class="text-sm text-zinc-500 dark:text-zinc-400">{{ ucfirst($key) }}</span>
                        <span class="text-sm font-medium">
                            @if (str($value)->startsWith('https://'))
                                <flux:link href="{{ $value }}" target="_blank">
                                    {{ str($value)->after('//')->after('www.')->before('/') }}
                                </flux:link>
                            @else
                                {{ $value }}
                            @endif
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if ($this->children->isNotEmpty())
        @foreach ($this->children->groupBy(fn ($child) => $child->type->value) as $type => $children)
            <div class="space-y-1">
                <div class="px-1 text-xs text-zinc-500 dark:text-zinc-400">{{ Str::ucfirst(Str::plural($type)) }}</div>
                <div class="divide-y divide-zinc-950/5 dark:divide-white/10 rounded-xl border border-zinc-950/5 dark:border-white/10">
                    @foreach ($children as $child)
                        <a href="{{ route('inventory.show', $child) }}" class="flex items-center gap-3 px-3 py-3 min-h-11 active:bg-zinc-950/5 dark:active:bg-white/5">
                            <flux:icon :name="$child->type->getIcon()" variant="mini" class="size-5 shrink-0 text-{{ $child->type->getIconColor() }}-500" />
                            <div class="min-w-0 flex-1">
                                <flux:heading class="truncate text-sm">{{ $child->truncated_name }}</flux:heading>
                            </div>
                            <flux:icon.chevron-right variant="micro" class="size-3.5 text-zinc-400 shrink-0" />
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    @endif
</div>

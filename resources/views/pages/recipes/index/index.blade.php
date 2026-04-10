<div class="p-4 space-y-4">
    <flux:input wire:model.live="search" placeholder="Search recipes..." icon="magnifying-glass" />

    <div class="divide-y divide-zinc-950/5 dark:divide-white/10 rounded-xl border border-zinc-950/5 dark:border-white/10">
        @foreach ($this->recipes as $recipe)
        <a href="{{ route('recipes.show', $recipe) }}" class="flex items-center gap-3 px-3 py-3 min-h-11 active:bg-zinc-950/5 dark:active:bg-white/5">
            @if ($recipe->photo_path)
                <img src="{{ Storage::temporaryUrl($recipe->photo_path, now()->addMinutes(30)) }}" alt="{{ $recipe->name }}" class="size-10 shrink-0 rounded-lg object-cover" />
            @else
                <flux:avatar size="sm" icon="book-open" />
            @endif
            <div class="min-w-0 flex-1">
                <flux:heading class="truncate text-sm">{{ $recipe->name }}</flux:heading>
                @if ($recipe->source)
                    <flux:text class="text-xs">
                        @if ($recipe->isSourceUrl())
                            {{ $recipe->shortenedSource() }}
                        @else
                            {{ $recipe->source }}
                        @endif
                    </flux:text>
                @elseif ($recipe->description)
                    <flux:text class="truncate text-xs">{{ $recipe->truncated_description }}</flux:text>
                @endif
            </div>
            <flux:icon.chevron-right variant="micro" class="size-3.5 text-zinc-400 shrink-0" />
        </a>
        @endforeach
    </div>
</div>

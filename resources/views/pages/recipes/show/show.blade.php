<div class="space-y-6 p-2">
    <div class="flex items-center gap-4">
        <flux:button :href="route('recipes.index')" icon="arrow-left" />
        <flux:heading size="xl" class="text-balance">{{ $recipe->name }}</flux:heading>
    </div>

    @if ($recipe->photo_path)
        <img src="{{ Storage::temporaryUrl($recipe->photo_path, now()->addMinutes(30)) }}" alt="{{ $recipe->name }}" class="w-full rounded-lg object-cover max-h-96" />
    @endif

    @if ($recipe->tags)
        <div class="flex flex-wrap gap-2">
            @foreach ($recipe->tags as $tag)
                <flux:badge size="sm">{{ $tag }}</flux:badge>
            @endforeach
        </div>
    @endif

    @if ($recipe->description)
        <flux:text class="text-pretty">{{ $recipe->description }}</flux:text>
    @endif

    <div class="divide-y divide-zinc-950/5 dark:divide-white/10 rounded-xl border border-zinc-950/5 dark:border-white/10">
        @if ($recipe->source)
            <div class="flex items-center justify-between px-3 py-3">
                <span class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('Source') }}</span>
                <span class="text-sm font-medium">
                    @if ($recipe->isSourceUrl())
                        <flux:link href="{{ $recipe->source }}" target="_blank">
                            {{ $recipe->shortenedSource() }}
                        </flux:link>
                    @else
                        {{ $recipe->source }}
                    @endif
                </span>
            </div>
        @endif

        @if ($recipe->servings)
            <div class="flex items-center justify-between px-3 py-3">
                <span class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('Servings') }}</span>
                <span class="text-sm tabular-nums">{{ $recipe->servings }}</span>
            </div>
        @endif

        @if ($recipe->prep_time)
            <div class="flex items-center justify-between px-3 py-3">
                <span class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('Prep time') }}</span>
                <span class="text-sm">{{ $recipe->prep_time }}</span>
            </div>
        @endif

        @if ($recipe->cook_time)
            <div class="flex items-center justify-between px-3 py-3">
                <span class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('Cook time') }}</span>
                <span class="text-sm">{{ $recipe->cook_time }}</span>
            </div>
        @endif

        @if ($recipe->total_time)
            <div class="flex items-center justify-between px-3 py-3">
                <span class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('Total time') }}</span>
                <span class="text-sm">{{ $recipe->total_time }}</span>
            </div>
        @endif
    </div>

    @if ($recipe->ingredients)
        <div class="space-y-1">
            <div class="px-1 text-xs text-zinc-500 dark:text-zinc-400">{{ __('Ingredients') }}</div>
            <div class="rounded-xl border border-zinc-950/5 dark:border-white/10 px-3 py-3">
                <x-prose :content="$recipe->ingredients" />
            </div>
        </div>
    @endif

    @if ($recipe->instructions)
        <div class="space-y-1">
            <div class="px-1 text-xs text-zinc-500 dark:text-zinc-400">{{ __('Instructions') }}</div>
            <div class="rounded-xl border border-zinc-950/5 dark:border-white/10 px-3 py-3">
                <x-prose :content="$recipe->instructions" />
            </div>
        </div>
    @endif

    @if ($recipe->notes)
        <div class="space-y-1">
            <div class="px-1 text-xs text-zinc-500 dark:text-zinc-400">{{ __('Notes') }}</div>
            <div class="rounded-xl border border-zinc-950/5 dark:border-white/10 px-3 py-3">
                <flux:text class="text-pretty">{{ $recipe->notes }}</flux:text>
            </div>
        </div>
    @endif

    @if ($recipe->nutrition)
        <div class="space-y-1">
            <div class="px-1 text-xs text-zinc-500 dark:text-zinc-400">{{ __('Nutrition') }}</div>
            <div class="rounded-xl border border-zinc-950/5 dark:border-white/10 px-3 py-3">
                <div class="prose dark:prose-invert text-sm">
                    {!! nl2br(e($recipe->nutrition)) !!}
                </div>
            </div>
        </div>
    @endif

    @if ($recipe->parent)
        <div class="space-y-1">
            <div class="px-1 text-xs text-zinc-500 dark:text-zinc-400">{{ __('Remixed from') }}</div>
            <div class="divide-y divide-zinc-950/5 dark:divide-white/10 rounded-xl border border-zinc-950/5 dark:border-white/10">
                <a href="{{ route('recipes.show', $recipe->parent) }}" class="flex items-center gap-3 px-3 py-3 min-h-11 active:bg-zinc-950/5 dark:active:bg-white/5">
                    <flux:avatar size="sm" icon="book-open" />
                    <div class="min-w-0 flex-1">
                        <flux:heading class="truncate text-sm">{{ $recipe->parent->name }}</flux:heading>
                        <flux:text class="text-xs">{{ $recipe->parent->team->name }}</flux:text>
                    </div>
                    <flux:icon.chevron-right variant="micro" class="size-3.5 text-zinc-400 shrink-0" />
                </a>
            </div>
        </div>
    @endif

    @if ($recipe->remixes->isNotEmpty())
        <div class="space-y-1">
            <div class="px-1 text-xs text-zinc-500 dark:text-zinc-400">{{ __('Remixes') }}</div>
            <div class="divide-y divide-zinc-950/5 dark:divide-white/10 rounded-xl border border-zinc-950/5 dark:border-white/10">
                @foreach ($recipe->remixes as $remix)
                    <a href="{{ route('recipes.show', $remix) }}" class="flex items-center gap-3 px-3 py-3 min-h-11 active:bg-zinc-950/5 dark:active:bg-white/5">
                        <flux:avatar size="sm" icon="book-open" />
                        <div class="min-w-0 flex-1">
                            <flux:heading class="truncate text-sm">{{ $remix->name }}</flux:heading>
                            <flux:text class="text-xs">{{ $remix->team->name }}</flux:text>
                        </div>
                        <flux:icon.chevron-right variant="micro" class="size-3.5 text-zinc-400 shrink-0" />
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>

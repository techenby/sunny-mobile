<div class="p-2 space-y-6">
    <flux:heading level="1" size="xl">{{ __('Recipes') }}</flux:heading>

    <flux:input wire:model.live="search" placeholder="Search" />

    <div class="divide-y divide-zinc-200 dark:divide-zinc-700">
        @foreach ($this->recipes as $recipe)
        <a href="{{ route('recipes.show', $recipe) }}" class="py-2 flex space-x-4">
            <flux:avatar icon="folder" size="xl" />
            <div class="space-y-1">
                <flux:heading>{{ $recipe->name }}</flux:heading>
                <dl class="flex gap-2">
                    @if ($recipe->source)
                    <div class="flex gap-2 items-center">
                        <dt><flux:icon.globe-americas variant="micro" /></dt>
                        <dd class="text-sm">
                            @if ($recipe->isSourceUrl())
                                {{ $recipe->shortenedSource() }}
                            @else
                                {{ $recipe->source }}
                            @endif
                        </dd>
                    </div>
                    @endif
                </dl>
                <flux:text>{{ $recipe->truncated_description }}</flux:text>
            </div>
        </a>
        @endforeach
    </div>
</div>

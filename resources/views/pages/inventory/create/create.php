<?php

use App\Enums\ItemType;
use App\Jobs\PushItem;
use App\Models\Item;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Add Item')] class extends Component
{
    public string $name = '';

    public ?string $type = null;

    public ?int $parent_id = null;

    /** @var array<int, array{key: string, value: string}> */
    public array $metadata = [];

    #[Computed]
    public function parentItems(): Collection
    {
        return Item::query()
            ->where('team_id', Auth::user()->current_team_id)
            ->orderBy('name')
            ->get(['id', 'name']);
    }

    public function addMetadata(): void
    {
        $this->metadata[] = ['key' => '', 'value' => ''];
    }

    public function removeMetadata(int $index): void
    {
        unset($this->metadata[$index]);
        $this->metadata = array_values($this->metadata);
    }

    public function save(): void
    {
        $data = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', Rule::enum(ItemType::class)],
            'parent_id' => ['nullable', 'integer', 'exists:items,id'],
            'metadata' => ['nullable', 'array'],
            'metadata.*.key' => ['nullable', 'string', 'max:255', 'distinct'],
            'metadata.*.value' => ['required_with:metadata.*.key', 'nullable', 'string', 'max:255'],
        ]);

        $metadata = collect($data['metadata'] ?? [])
            ->filter(fn (array $pair): bool => $pair['key'] !== '')
            ->mapWithKeys(fn (array $pair): array => [$pair['key'] => $pair['value']])
            ->all() ?: null;

        $item = Item::query()->create([
            'team_id' => Auth::user()->current_team_id,
            'name' => $data['name'],
            'type' => $data['type'],
            'parent_id' => $data['parent_id'] ?: null,
            'metadata' => $metadata,
        ]);

        dispatch(new PushItem($item));

        $this->redirectRoute('inventory.show', $item, navigate: true);
    }
};

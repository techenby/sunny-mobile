<?php

use App\Models\Item;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Inventory')] class extends Component
{
    public string $search = '';

    #[Computed]
    public function items(): Collection
    {
        return Item::query()
            ->where('team_id', Auth::user()->current_team_id)
            ->when($this->search !== '', fn ($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->orderBy('name')
            ->get();
    }
};

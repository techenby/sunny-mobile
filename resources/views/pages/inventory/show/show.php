<?php

use App\Models\Item;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    public Item $item;

    public function render()
    {
        return $this->view()
            ->title($this->item->name);
    }

    #[Computed]
    public function breadcrumbs(): Collection
    {
        $breadcrumbs = collect();
        $current = $this->item->parent_id
            ? Item::query()->where('team_id', Auth::user()->current_team_id)->find($this->item->parent_id)
            : null;

        while ($current) {
            $breadcrumbs->prepend($current);
            $current = $current->parent;
        }

        return $breadcrumbs;
    }

    #[Computed]
    public function children(): Collection
    {
        return $this->item->children()->orderBy('name')->get();
    }
};

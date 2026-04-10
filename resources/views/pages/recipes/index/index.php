<?php

use App\Models\Recipe;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Recipes')] class extends Component
{
    public string $search = '';

    #[Computed]
    public function recipes(): Collection
    {
        return Recipe::query()
            ->where('team_id', Auth::user()->current_team_id)
            ->when($this->search !== '', fn ($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->orderBy('name')
            ->get();
    }
};

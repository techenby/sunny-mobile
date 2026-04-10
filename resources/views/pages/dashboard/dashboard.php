<?php

use App\Jobs\SyncData;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Dashboard')] class extends Component
{
    #[Computed]
    public function stats(): array
    {
        return [
            'recipes' => Auth::user()->currentTeam?->recipes()->count() ?? 0,
            'items' => Auth::user()->currentTeam?->items()->count() ?? 0,
        ];
    }

    public function sync(): void
    {
        dispatch(new SyncData(Auth::user()));
    }
};

<?php

use App\Jobs\SyncData;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Native\Mobile\Facades\SecureStorage;

new #[Title('Dashboard')] class extends Component {
    #[Computed]
    public function stats()
    {
        return [
            'recipes' => Auth::user()->currentTeam?->recipes()->count() ?? 0,
            'items' => Auth::user()->currentTeam?->items()->count() ?? 0,
        ];
    }

    public function sync()
    {
        dispatch(new SyncData(Auth::user()));
    }
};

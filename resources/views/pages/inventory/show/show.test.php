<?php

use App\Models\Item;
use App\Models\User;
use Livewire\Livewire;

test('renders successfully', function (): void {
    $user = User::factory()->create();
    $item = Item::factory()->for($user->currentTeam)->create();

    $this->actingAs($user)
        ->get(route('inventory.show', $item))
        ->assertOk();

    Livewire::actingAs($user)
        ->test('pages::inventory.show', ['item' => $item])
        ->assertOk();
})->group('smoke');

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

test('displays item details and parent', function (): void {
    $user = User::factory()->create();
    $parent = Item::factory()->for($user->currentTeam)->create(['type' => 'location']);
    $item = Item::factory()->for($user->currentTeam)->create(['parent_id' => $parent->id]);

    Livewire::actingAs($user)
        ->test('pages::inventory.show', ['item' => $item])
        ->assertOk()
        ->assertSee($item->name)
        ->assertSee($parent->name)
        ->assertSee('Location');
});

test('displays children when item has children', function (): void {
    $user = User::factory()->create();
    $item = Item::factory()->for($user->currentTeam)->create(['type' => 'location']);
    $children = Item::factory()->for($user->currentTeam)->count(3)->create(['parent_id' => $item->id]);

    Livewire::actingAs($user)
        ->test('pages::inventory.show', ['item' => $item])
        ->assertOk()
        ->assertSee($children->first()->name);
});

<?php

use App\Models\Item;
use App\Models\User;
use Livewire\Livewire;

test('renders successfully', function (): void {
    $user = User::factory()->create();
    Item::factory()->for($user->currentTeam)->create(['name' => 'Rocking Chair']);

    $this->actingAs($user)
        ->get(route('inventory.index'))
        ->assertOk()
        ->assertSee('Rocking Chair');

    Livewire::actingAs($user)
        ->test('pages::inventory.index')
        ->assertOk()
        ->assertSee('Rocking Chair');
})->group('smoke');

test('can search items', function () {
    $user = User::factory()->create();
    Item::factory()->for($user->currentTeam)
        ->count(2)
        ->sequence(
            ['name' => 'Rocking Chair'],
            ['name' => 'Art Box'],
        )
        ->create();

    Livewire::actingAs($user)
        ->test('pages::inventory.index')
        ->assertSee('Rocking Chair')
        ->assertSee('Art Box')
        ->set('search', 'chair')
        ->assertSee('Rocking Chair')
        ->assertDontSee('Art Box');
});

test('shows only root items by default', function () {
    $user = User::factory()->create();
    $location = Item::factory()->for($user->currentTeam)->create(['name' => 'Garage', 'type' => 'location']);
    $child = Item::factory()->for($user->currentTeam)->create(['name' => 'Tool Box', 'parent_id' => $location->id]);

    Livewire::actingAs($user)
        ->test('pages::inventory.index')
        ->assertSee('Garage')
        ->assertDontSee('Tool Box');
});

test('can drill into a parent item', function () {
    $user = User::factory()->create();
    $location = Item::factory()->for($user->currentTeam)->create(['name' => 'Garage', 'type' => 'location']);
    $rootItem = Item::factory()->for($user->currentTeam)->create(['name' => 'Rocking Chair']);
    $child = Item::factory()->for($user->currentTeam)->create(['name' => 'Tool Box', 'parent_id' => $location->id]);

    Livewire::actingAs($user)
        ->test('pages::inventory.index', ['parentId' => $location->id])
        ->assertSee('Tool Box')
        ->assertDontSee('Rocking Chair');
});

test('shows breadcrumbs when inside a folder', function () {
    $user = User::factory()->create();
    $location = Item::factory()->for($user->currentTeam)->create(['name' => 'Garage', 'type' => 'location']);
    $bin = Item::factory()->for($user->currentTeam)->create(['name' => 'Shelf A', 'type' => 'bin', 'parent_id' => $location->id]);

    Livewire::actingAs($user)
        ->test('pages::inventory.index', ['parentId' => $bin->id])
        ->assertSee('Garage')
        ->assertSee('Shelf A');
});

test('shows empty state when folder has no children', function () {
    $user = User::factory()->create();
    $location = Item::factory()->for($user->currentTeam)->create(['name' => 'Garage', 'type' => 'location']);

    Livewire::actingAs($user)
        ->test('pages::inventory.index', ['parentId' => $location->id])
        ->assertSee('Nothing here yet');
});

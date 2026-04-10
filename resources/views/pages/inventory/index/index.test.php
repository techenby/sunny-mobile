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

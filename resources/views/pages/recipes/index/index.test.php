<?php

use App\Models\Recipe;
use App\Models\User;
use Livewire\Livewire;

test('renders successfully', function (): void {
    $user = User::factory()->create();
    Recipe::factory()->for($user->currentTeam)->create(['name' => 'Chocolate Chip Cookies']);

    $this->actingAs($user)
        ->get(route('recipes.index'))
        ->assertOk()
        ->assertSee('Chocolate Chip Cookies');

    Livewire::actingAs($user)
        ->test('pages::recipes.index')
        ->assertOk()
        ->assertSee('Chocolate Chip Cookies');
})->group('smoke');

test('can search items', function () {
    $user = User::factory()->create();
    Recipe::factory()->for($user->currentTeam)
        ->count(2)
        ->sequence(
            ['name' => 'Chocolate Chip Cookies'],
            ['name' => 'Chicken Dinner'],
        )
        ->create();

    Livewire::actingAs($user)
        ->test('pages::recipes.index')
        ->assertSee('Chocolate Chip Cookies')
        ->assertSee('Chicken Dinner')
        ->set('search', 'cookies')
        ->assertSee('Chocolate Chip Cookies')
        ->assertDontSee('Chicken Dinner');
});

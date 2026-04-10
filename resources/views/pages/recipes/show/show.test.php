<?php

use App\Models\Recipe;
use App\Models\User;
use Livewire\Livewire;

test('renders successfully', function (): void {
    $user = User::factory()->create();
    $recipe = Recipe::factory()->for($user->currentTeam)->create();

    $this->actingAs($user)
        ->get(route('recipes.show', $recipe))
        ->assertOk();

    Livewire::actingAs($user)
        ->test('pages::recipes.show', ['recipe' => $recipe])
        ->assertOk();
})->group('smoke');

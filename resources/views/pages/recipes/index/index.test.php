<?php

use App\Models\User;
use Livewire\Livewire;

test('renders successfully', function (): void {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('recipes.index'))
        ->assertOk();

    Livewire::actingAs($user)
        ->test('pages::recipes.index')
        ->assertOk();
})->group('smoke');

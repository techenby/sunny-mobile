<?php

use App\Models\User;
use Livewire\Livewire;

test('renders successfully', function (): void {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('inventory.index'))
        ->assertOk();

    Livewire::actingAs($user)
        ->test('pages::inventory.index')
        ->assertOk();
})->group('smoke');

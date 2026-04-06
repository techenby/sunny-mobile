<?php

use App\Models\User;
use Livewire\Livewire;

test('renders successfully', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('dashboard'))
        ->assertOk();

    Livewire::actingAs($user)
        ->test('pages::dashboard')
        ->assertOk();
})->group('smoke');

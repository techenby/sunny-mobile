<?php

use Livewire\Livewire;

test('renders successfully', function (): void {
    $this->get(route('register'))
        ->assertOk();

    Livewire::test('pages::auth.register')
        ->assertOk();
})->group('smoke');

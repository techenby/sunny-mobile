<?php

use Livewire\Livewire;

test('renders successfully', function (): void {
    $this->get(route('splash'))
        ->assertOk();

    Livewire::test('pages::splash')
        ->assertOk();
})->group('smoke');

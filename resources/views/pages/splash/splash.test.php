<?php

use Livewire\Livewire;

test('renders successfully', function () {
    $this->get(route('splash'))
        ->assertOk();

    Livewire::test('pages::splash')
        ->assertOk();
})->group('smoke');

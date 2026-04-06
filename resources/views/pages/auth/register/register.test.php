<?php

use Livewire\Livewire;

test('renders successfully', function () {
    $this->get(route('register'))
        ->assertOk();

    Livewire::test('pages::auth.register')
        ->assertOk();
})->group('smoke');

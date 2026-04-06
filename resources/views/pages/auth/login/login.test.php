<?php

use Livewire\Livewire;

test('component renders successfully', function () {
    $this->get(route('login'))
        ->assertOk();

    Livewire::test('pages::auth.login')
        ->assertOk();
})->group('smoke');

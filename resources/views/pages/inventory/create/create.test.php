<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::inventory.create')
        ->assertStatus(200);
});

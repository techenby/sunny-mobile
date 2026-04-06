<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::splash')
        ->assertStatus(200);
});

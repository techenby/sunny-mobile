<?php

use Livewire\Livewire;

it('renders successfully', function (): void {
    Livewire::test('pages::inventory.show')
        ->assertStatus(200);
});

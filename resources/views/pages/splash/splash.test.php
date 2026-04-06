<?php

use Livewire\Livewire;

it('renders successfully', function (): void {
    Livewire::test('pages::splash')
        ->assertStatus(200);
});

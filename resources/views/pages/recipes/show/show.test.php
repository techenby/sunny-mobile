<?php

use Livewire\Livewire;

it('renders successfully', function (): void {
    Livewire::test('pages::recipes.show')
        ->assertStatus(200);
});

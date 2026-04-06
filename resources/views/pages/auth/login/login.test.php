<?php

use App\Models\User;
use Livewire\Livewire;

test('component renders successfully', function () {
    $this->get(route('login'))
        ->assertOk();

    Livewire::test('pages::auth.login')
        ->assertOk();
})->group('smoke');

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();

    Livewire::test('pages::auth.login')
        ->set('email', $user->email)
        ->set('password', 'password')
        ->call('login')
        ->assertValid()
        ->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticated();
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    Livewire::test('pages::auth.login')
        ->call('login')
        ->assertHasErrors(['email', 'password']);

    $this->assertGuest();
});

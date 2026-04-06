<?php

use App\Integrations\Sunny\Requests\CreateAccessToken;
use App\Models\User;
use Livewire\Livewire;
use Saloon\Http\Faking\MockResponse;
use Saloon\Laravel\Facades\Saloon;

test('renders successfully', function (): void {
    $this->get(route('login'))
        ->assertOk();

    Livewire::test('pages::auth.login')
        ->assertOk();
})->group('smoke');

test('users can authenticate using the login screen', function (): void {
    Saloon::fake([
        CreateAccessToken::class => MockResponse::make([
            'id' => 1,
            'name' => 'Monkey D. Luffy',
            'email' => 'luffy@strawhat.pirates',
            'current_team_id' => 1,
            'token' => '1|abcdefghijklmnopqrstuvwxyz',
        ]),
    ]);

    Livewire::test('pages::auth.login')
        ->set('email', 'luffy@strawhat.pirates')
        ->set('password', 'password')
        ->call('login')
        ->assertValid()
        ->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticated();

    $this->assertDatabaseHas('users', [
        'id' => 1,
        'name' => 'Monkey D. Luffy',
        'email' => 'luffy@strawhat.pirates',
        'token' => '1|abcdefghijklmnopqrstuvwxyz',
    ]);
});

test('users can not authenticate with invalid password', function (): void {
    $user = User::factory()->create();

    Livewire::test('pages::auth.login')
        ->call('login')
        ->assertHasErrors(['email', 'password']);

    $this->assertGuest();
});

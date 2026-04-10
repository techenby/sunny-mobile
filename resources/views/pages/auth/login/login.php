<?php

use App\Integrations\Sunny\Requests\CreateAccessToken;
use App\Integrations\Sunny\SunnyConnector;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::guest')] #[Title('Log in')] class extends Component
{
    public string $email;
    public string $password;

    public function login(): void
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        /** @var array{id: int, email: string, name: string} $userData */
        $userData = (new SunnyConnector)
            ->send(new CreateAccessToken([
                'email' => $this->email,
                'password' => $this->password,
                'device_name' => 'tinkerwell',
            ]))
            ->json();

        $user = User::query()->updateOrCreate(
            ['id' => $userData['id']],
            Arr::only($userData, ['id', 'name', 'email', 'token', 'current_team_id']),
        );

        Auth::login($user);

        $this->redirectIntended(route('dashboard'));
    }
};

<?php

use App\Integrations\Sunny\Requests\CreateAccessToken;
use App\Integrations\Sunny\SunnyConnector;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::guest')] #[Title('Log in')] class extends Component
{
    public string $email;
    public string $password;

    public function login(): RedirectResponse
    {
        $data = $this->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $userData = (new SunnyConnector)
            ->send(new CreateAccessToken([
                ...$data,
                'device_name' => 'tinkerwell',
            ]))
            ->json();

        $user = User::query()->firstOrCreate(['id' => $userData['id']], $userData);

        Auth::login($user);

        return redirect()->intended('dashboard');
    }
};

<?php

use App\Actions\Login;
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

        resolve(Login::class)->handle($this->email, $this->password);

        $this->redirectIntended(route('dashboard'));
    }
};

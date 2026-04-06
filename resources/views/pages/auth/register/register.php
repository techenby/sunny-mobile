<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::guest')] #[Title('Register')] class extends Component
{
    public string $name;
    public string $email;
    public string $password;
    public string $password_confirmation;

    public function register()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // todo, integrate with sanctum

        return redirect()->intended('dashboard');
    }
};

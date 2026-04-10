<?php

declare(strict_types=1);

namespace App\Actions;

use App\Integrations\Sunny\Requests\CreateAccessToken;
use App\Integrations\Sunny\SunnyConnector;
use App\Jobs\SyncData;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Native\Mobile\Facades\Device;
use Native\Mobile\Facades\SecureStorage;

class Login
{
    public function handle(string $email, string $password): void
    {
        DB::transaction(function () use ($email, $password): void {
            /** @var array{id: int, email: string, name: string, token: string} $userData */
            $userData = (new SunnyConnector)
                ->send(new CreateAccessToken([
                    'email' => $email,
                    'password' => $password,
                    'device_name' => Device::getId(),
                ]))
                ->json();

            $user = User::query()->updateOrCreate(
                ['id' => $userData['id']],
                Arr::only($userData, ['id', 'name', 'email', 'current_team_id']),
            );

            SecureStorage::set('token', $userData['token']);
            SecureStorage::set('user_id', $user->id);

            dispatch(new SyncData($user));

            Auth::login($user);
        });
    }
}

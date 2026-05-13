<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Integrations\Sunny\Requests\Sync;
use App\Integrations\Sunny\SunnyConnector;
use App\Models\Item;
use App\Models\Recipe;
use App\Models\Team;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Auth;
use Native\Mobile\Facades\SecureStorage;
use Saloon\Exceptions\Request\Statuses\UnauthorizedException;

class SyncData implements ShouldQueue
{
    use Queueable;

    public function __construct(public User $user) {}

    public function handle(): void
    {
        try {
            $token = SecureStorage::get('token');

            $response = (new SunnyConnector($token))->send(new Sync)->dto();
        } catch (UnauthorizedException) {
            SecureStorage::delete('token');
            SecureStorage::delete('user_id');

            Auth::logout();

            $this->redirectRoute('login');
        }

        Team::query()->upsert(
            $response['teams'],
            uniqueBy: ['id'],
            update: ['name', 'is_personal', 'created_at', 'updated_at', 'deleted_at'],
        );

        // add/remove team memberships

        Recipe::query()->upsert(
            $response['recipes'],
            uniqueBy: ['id'],
            update: ['name', 'slug', 'source', 'servings', 'prep_time', 'cook_time', 'total_time', 'description', 'ingredients', 'instructions', 'notes', 'nutrition', 'share_token', 'tags', 'created_at', 'updated_at',  'deleted_at'],
        );

        Item::query()->upsert(
            $response['items'],
            uniqueBy: ['id'],
            update: ['team_id', 'parent_id', 'name', 'type', 'metadata', 'created_at', 'updated_at', 'deleted_at'],
        );
    }
}

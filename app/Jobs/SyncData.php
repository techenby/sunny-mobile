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

class SyncData implements ShouldQueue
{
    use Queueable;

    public function __construct(public User $user) {}

    public function handle(): void
    {
        $response = (new SunnyConnector($this->user->token))->send(new Sync)->dto();

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

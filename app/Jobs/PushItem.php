<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Integrations\Sunny\Requests\Inventory\StoreItem;
use App\Integrations\Sunny\SunnyConnector;
use App\Models\Item;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Native\Mobile\Facades\SecureStorage;

class PushItem implements ShouldQueue
{
    use Queueable;

    public function __construct(public Item $item) {}

    public function handle(): void
    {
        $token = SecureStorage::get('token');

        $response = (new SunnyConnector($token))->send(new StoreItem([
            'name' => $this->item->name,
            'type' => $this->item->type->value,
            'parent_id' => $this->item->parent_id,
            'metadata' => $this->item->metadata,
        ]));

        $serverId = (int) ($response->json('data.id') ?? $response->json('id'));

        if ($serverId === 0 || $serverId === $this->item->id) {
            return;
        }

        Item::query()->where('id', $this->item->id)->update(['id' => $serverId]);
    }
}

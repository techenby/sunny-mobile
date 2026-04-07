<?php

declare(strict_types=1);

namespace App\Integrations\Sunny\Requests\Inventory;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteItem extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(protected int $id) {}

    public function resolveEndpoint(): string
    {
        return '/items/' . $this->id;
    }
}

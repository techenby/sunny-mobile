<?php

declare(strict_types=1);

namespace App\Integrations\Sunny\Requests\Inventory;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetItems extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/items';
    }
}

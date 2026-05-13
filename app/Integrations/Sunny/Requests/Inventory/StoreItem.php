<?php

declare(strict_types=1);

namespace App\Integrations\Sunny\Requests\Inventory;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class StoreItem extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /** @param array{name: string, type: string, parent_id: ?int, metadata: ?array<string, string>} $payload */
    public function __construct(protected array $payload) {}

    public function resolveEndpoint(): string
    {
        return '/items';
    }

    /** @return array<string, mixed> */
    protected function defaultBody(): array
    {
        return $this->payload;
    }
}
